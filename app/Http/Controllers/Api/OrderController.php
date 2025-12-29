<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Address; 
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\SakuRupiahService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    protected $paymentService;

    public function __construct(SakuRupiahService $service)
    {
        $this->paymentService = $service;
    }

    public function index(Request $request)
    {
        $user = $request->user();

        // Cek dulu user punya data customer gak
        if (!$user->customer) {
            return response()->json(['data' => []]);
        }

        // Ambil order berdasarkan customer_id milik user ini
        $orders = Order::where('customer_id', $user->customer->id)
            ->with(['items.product', 'address']) // Load detail produk & alamat
            ->latest()
            ->get();

        return response()->json(['data' => $orders]);
    }

    // --- LOGIC CHECKOUT / STORE (SUDAH DIPERMUDAH) ---
    public function store(Request $request)
    {
        // 1. Validasi Input MINIMALIS (Cuma Nama, HP, Alamat)
        // Kita validasi array 'shipping_address' yang dikirim dari React
        $validated = $request->validate([
            'shipping_address.name'    => 'required|string',
            'shipping_address.phone'   => 'required|string',
            'shipping_address.address' => 'required|string',
            'shipping_address.notes'   => 'nullable|string',
        ]);

        $user = $request->user();
        
        // Ambil data dari payload frontend
        $shippingData = $request->input('shipping_address');

        // Cek data Customer
        $customer = $user->customer; 

        // AUTO-CREATE CUSTOMER jika belum ada
        if (!$customer) {
            $customer = Customer::create([
                'user_id' => $user->id,
                'name'    => $shippingData['name'], // Pakai nama dari form checkout
                'email'   => $user->email,
                'phone'   => $shippingData['phone'],
            ]);
        }

        // 2. Cek Keranjang
        $cartItems = CartItem::where('user_id', $user->id)
                        ->with(['variant.product']) 
                        ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Keranjang kosong.'], 400);
        }

        // 3. Hitung Total Harga
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            if (!$item->variant) continue; 
            $totalPrice += $item->variant->price * $item->quantity;
        }

        DB::beginTransaction();
        try {
            
            // 4. CREATE ADDRESS (Diakali biar gak error Database)
            // Karena frontend cuma kirim 'address' panjang, kolom detail lain kita isi strip (-)
            $address = Address::create([
                'customer_id'    => $customer->id,
                'recipient_name' => $shippingData['name'],
                'phone'          => $shippingData['phone'],
                'street'         => $shippingData['address'], // Alamat lengkap masuk sini
                
                // BYPASS VALIDASI DB: Isi default biar gak error SQL
                'city'           => '-', 
                'province'       => '-',
                'postal_code'    => '-', 
            ]);

            // 5. Buat Invoice Number
            $orderNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5));

            // 6. Buat Order
            $order = Order::create([
                'order_number'   => $orderNumber,
                'customer_id'    => $customer->id,
                'address_id'     => $address->id,
                'order_date'     => now(),
                'status'         => 'pending',
                'payment_method' => 'qris', // Default aja ke QRIS/Gateway
                'total_price'    => $totalPrice,
                'notes'          => $shippingData['notes'] ?? null,
            ]);

            // 7. Pindahkan Item ke OrderItem
            foreach ($cartItems as $item) {
                if (!$item->variant) continue;

                OrderItem::create([
                    'order_id'           => $order->id,
                    'product_id'         => $item->variant->product_id ?? null, 
                    'product_variant_id' => $item->variant_id, // Pastikan ini variant_id bukan product_variant_id kalau di model cart beda
                    'quantity'           => $item->quantity,
                    'price'              => $item->variant->price, 
                ]);
            }

            // 8. Payment Gateway Service
            $paymentResponse = $this->paymentService->createTransaction($order, $user);
            
            // Ambil URL dari response (sesuai struktur JSON lu yang ada array-nya)
            // Cek apakah data bentuknya array [0] atau object langsung
            $responseData = $paymentResponse['data'][0] ?? $paymentResponse['data'] ?? [];
            $checkoutUrl = $responseData['checkout_url'] ?? null;
            $externalId = $responseData['id'] ?? $responseData['trx_id'] ?? null;

            $qrImage = null;

            // ! --- LOGIC SCRAPING (START) ---
            if ($checkoutUrl) {
                try {
                    // 1. Request HTML
                    $response = Http::withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
                    ])->timeout(10)->get($checkoutUrl);

                    $html = $response->body();
                    
                    preg_match('/<img[^>]+src="([^"]+)"[^>]*alt="QRIS Pembayaran"/i', $html, $matches);

                    if (isset($matches[1])) {
                        $qrImage = $matches[1]; // Kita ambil capture group ke-1 (URL-nya)
                    } else {
                        // DEBUG: Kalau masih gagal, kita catet HTML-nya buat bukti
                        Log::error("Scraping Gagal. HTML tidak mengandung alt='QRIS Pembayaran'. Cek Log untuk isi HTML.");
                        // Log 500 karakter pertama body buat ngecek apakah ini halaman Loading/JS
                        Log::info("HTML Snippet: " . substr($html, 0, 500)); 
                    }

                } catch (\Exception $e) {
                    Log::error("Scraping Error: " . $e->getMessage());
                }
            }
            // ! --- LOGIC SCRAPING (END) ---

            $order->update([
                'payment_url' => $checkoutUrl,
                'external_id' => $externalId
            ]);

            // 9. Kosongkan Keranjang
            CartItem::where('user_id', $user->id)->delete();

            DB::commit();

            return response()->json([
                'status'      => 'success',
                'message'     => 'Order created',
                'payment_url' => $checkoutUrl,
                'qr_image'    => $qrImage, // <--- INI HASILNYA (Bisa URL Gambar, bisa NULL)
                'address'     => $address 
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Checkout Error: " . $e->getMessage());
            return response()->json(['message' => 'Checkout Failed: ' . $e->getMessage()], 500);
        }
    }

    public function show(Order $order)
    {
        return response()->json($order->load(['customer', 'address', 'items.product']));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'sometimes|in:pending,processing,delivered,canceled',
            'tracking_number' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);
        $order->update($validated);
        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->noContent();
    }
}