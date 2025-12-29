<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem; // Pastikan model CartItem ada
use App\Models\Customer; // Pastikan model Customer ada
use Illuminate\Http\Request;
use App\Services\SakuRupiahService; // Import Service tadi
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    protected $paymentService;

    // Inject Service SakuRupiah ke Controller
    public function __construct(SakuRupiahService $service)
    {
        $this->paymentService = $service;
    }

    // Method INDEX (Tetap sama, cuma nampilin list)
    public function index()
    {
        // Saya tambahkan order by desc biar yang terbaru diatas
        return response()->json(Order::with(['customer', 'address', 'items'])->latest()->paginate(10));
    }

    // Method STORE (Ini LOGIC CHECKOUT UTAMA)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $user = $request->user();

        // -------------------------------------------------------------
        // LOGIC USER VS CUSTOMER
        // Karena di User.php kamu ada relasi public function customer(),
        // Kita cek dulu apakah user ini sudah punya data customer?
        // -------------------------------------------------------------
        $customer = $user->customer; 

        // Kalau belum ada, opsinya: Error atau Auto-create. 
        // Di sini kita return error biar aman, user harus lengkapi profil dulu.
        if (!$customer) {
            return response()->json(['message' => 'Data customer tidak ditemukan pada user ini.'], 400);
        }

        // 2. Ambil Keranjang User + LOAD RELASI VARIANT
        // Kita WAJIB pakai ->with('variant') supaya bisa ambil harganya
        $cartItems = \App\Models\CartItem::where('user_id', $user->id)
                        ->with(['variant.product']) // Load varian DAN produk induknya
                        ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Keranjang kosong.'], 400);
        }

        // 3. Hitung Total Harga (Ambil harga dari VARIANT, bukan cart item)
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            // Pastikan varian masih ada (takutnya udah dihapus admin)
            if (!$item->variant) continue; 
            
            $totalPrice += $item->variant->price * $item->quantity;
        }

        DB::beginTransaction();
        try {
            // 4. Buat Invoice Number
            $orderNumber = 'INV-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5));

            // 5. Buat Order
            $order = \App\Models\Order::create([
                'order_number' => $orderNumber,
                'customer_id' => $customer->id, // Pakai ID dari tabel customers
                'address_id' => $validated['address_id'],
                'order_date' => now(),
                'status' => 'pending',
                'payment_method' => $validated['payment_method'],
                'total_price' => $totalPrice,
                'notes' => $request->notes,
            ]);

            // 6. Pindahkan Item ke OrderItem
            foreach ($cartItems as $item) {
                if (!$item->variant) continue;

                \App\Models\OrderItem::create([
                    'order_id' => $order->id,
                    // Ambil Product ID dari relasi variant -> product
                    'product_id' => $item->variant->product_id ?? null, 
                    'product_variant_id' => $item->product_variant_id,
                    'quantity' => $item->quantity,
                    // Ambil Harga dari Variant saat ini (Price Snapshot)
                    'price' => $item->variant->price, 
                ]);
            }

            // 7. Panggil Service SakuRupiah
            // Kita kirim data $user karena di User.php ada email/phone yang lengkap
            $paymentResponse = $this->paymentService->createTransaction($order, $user);
            
            $paymentUrl = $paymentResponse['data']['checkout_url'] ?? null;
            $externalId = $paymentResponse['data']['id'] ?? null;

            $order->update([
                'payment_url' => $paymentUrl,
                'external_id' => $externalId
            ]);

            // 8. Hapus Keranjang
            \App\Models\CartItem::where('user_id', $user->id)->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Order created',
                'payment_url' => $paymentUrl,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Checkout Failed: ' . $e->getMessage()], 500);
        }
    }

    // Method SHOW (Detail Order)
    public function show(Order $order)
    {
        return response()->json($order->load(['customer', 'address', 'items.product'])); // Load relasi produk di item
    }

    // Method UPDATE & DESTROY biarkan saja seperti file aslimu
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