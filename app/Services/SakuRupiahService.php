<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SakuRupiahService
{
    protected $apiUrl;
    protected $apiKey;
    protected $apiId;

    public function __construct()
    {
        // Pastikan .env sudah benar (tanpa private key, cukup API Key & ID)
        $this->apiUrl = env('SAKURUPIAH_API_URL');
        $this->apiKey = env('SAKURUPIAH_API_KEY');
        $this->apiId  = env('SAKURUPIAH_API_ID');
    }

    public function createTransaction($order, $user, $paymentMethod = 'QRIS')
    {
        // Hapus slash di ujung URL kalau ada, lalu gabung dengan endpoint
        $baseUrl = rtrim($this->apiUrl, '/'); 
        $endpoint = $baseUrl . '/create.php';

        // 1. Siapkan Data Dasar
        $amount = (int) $order->total_price;
        $merchantRef = $order->order_number; // Kode unik merchant (INV-xxx)

        // 2. Generate Signature (SESUAI CONTOH KODE ANDA)
        // Rumus: hash_hmac('sha256', api_id + method + merchant_ref + amount, apikey)
        $signatureString = $this->apiId . $paymentMethod . $merchantRef . $amount;
        $signature = hash_hmac('sha256', $signatureString, $this->apiKey);

        // 3. Siapkan Payload
        $payload = [
            'api_id'       => $this->apiId,
            'method'       => $paymentMethod, 
            'merchant_ref' => $merchantRef,
            'amount'       => $amount,
            'merchant_fee' => '1', // 1 = Merchant tanggung fee
            'expired'      => '1', 
            'name'         => $user->name,
            'email'        => $user->email,
            'phone'        => $this->formatPhone($user->phone),
            'callback_url' => 'https://api.thecolheta.com/api/payment/notification',
            'return_url'   => 'https://thecolheta.com/profile', // Ganti dengan URL frontend riwayat pesanan
            'signature'    => $signature, // Signature yang sudah diperbaiki
        ];

        // 4. Masukkan Data Produk (Array Style)
        foreach ($order->items as $index => $item) {
            // Mengambil nama produk. Jika relasi product diload, gunakan nama produknya.
            // Jika tidak, gunakan fallback string.
            $productName = $item->product ? $item->product->name : ($item->product_name ?? 'Item Produk');
            
            $payload["produk[$index]"] = $productName;
            $payload["qty[$index]"]    = $item->quantity;
            $payload["harga[$index]"]  = (int) $item->price;
            
            // Ambil size jika ada varian
            $size = '-';
            if ($item->variant) {
                $size = $item->variant->size ?? '-';
            }
            $payload["size[$index]"]   = $size;
            $payload["note[$index]"]   = '-';
        }

        // 5. Kirim Request
        // Karena Postman bilang 'formdata', kita pakai asForm()
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->asForm()->post($endpoint, $payload);

        // 6. Cek Response
        if ($response->successful()) {
            $result = $response->json();
            
            // Cek status dari body response SakuRupiah
            if (isset($result['status']) && $result['status'] == true) {
                 return $result; 
            }
            
            Log::error('SakuRupiah Transaction Failed', ['response' => $result]);
            // Tampilkan pesan error spesifik dari SakuRupiah jika ada
            $msg = $result['message'] ?? 'Gagal membuat transaksi';
            throw new \Exception('SakuRupiah Error: ' . $msg);
        }

        Log::error('SakuRupiah Error', ['status' => $response->status(), 'body' => $response->body()]);

        // Biar error aslinya muncul di Postman
        throw new \Exception('SakuRupiah Error (' . $response->status() . '): ' . $response->body());
    }

    private function formatPhone($phone)
    {
        if (!$phone) return '08123456789';
        // Ubah 08xx jadi 628xx atau sesuai format yang diminta
        // Postman contoh: 62821...
        if (substr($phone, 0, 2) == '08') {
            return '62' . substr($phone, 1);
        }
        return $phone;
    }
}