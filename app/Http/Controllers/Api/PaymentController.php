<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function handleCallback(Request $request)
    {
        // 1. Ambil Data Header & Body
        // Coba ambil dari request header (Laravel Style)
        $incomingSignature = $request->header('X-Callback-Signature');
        
        // Cek juga array SERVER global jika header diatas tidak terbaca (Fallback cPanel)
        if (!$incomingSignature && isset($_SERVER['HTTP_X_CALLBACK_SIGNATURE'])) {
             $incomingSignature = $_SERVER['HTTP_X_CALLBACK_SIGNATURE'];
        }

        Log::info('SAKURUPIAH_CALLBACK_RECEIVED', [
            'raw_body' => $request->getContent(),
            'headers'  => $request->headers->all(),
        ]);

        $event = $request->header('X-Callback-Event');
        $json = $request->getContent(); 

        // 2. Ambil API Key
        $apiKey = env('SAKURUPIAH_API_KEY');

        // 3. Validasi Signature
        $mySignature = hash_hmac('sha256', $json, $apiKey);

        if ($incomingSignature !== $mySignature) {
            Log::warning('Invalid Callback Signature', ['expected' => $mySignature, 'received' => $incomingSignature, 'body' => $json]);
            return response()->json(['success' => false, 'message' => 'Invalid signature'], 400);
        }

        // 4. Validasi Event (Pakai header yang sudah ada)
        if ($event !== 'payment_status') {
            return response()->json(['success' => false, 'message' => 'Unrecognized event'], 400);
        }

        // 5. Decode JSON
        $data = json_decode($json);
        $merchantRef = $data->merchant_ref; // Order Number (INV-xxx)
        $status = $data->status;
        // PENTING: Tambahkan pengambilan Status Kode
        $statusCode = $data->status_kode; 

        // 6. Cari Order
        $order = Order::where('order_number', $merchantRef)->first();

        if (!$order) {
            Log::warning('Callback Order Not Found', ['ref' => $merchantRef]);
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        // 7. Update Status (Sesuai dengan Docs: status string DAN status_kode)
        
        // Status BERHASIL (status == "berhasil" dan status_kode == 1)
        if ($status === 'berhasil' && $statusCode == 1) {
            if ($order->status !== 'processing') { // Cek agar tidak update berkali-kali
                 $order->update(['status' => 'processing']); 
            }
            Log::info('Order Successfully Paid', ['order_number' => $merchantRef]);
        
        // Status EXPIRED (status == "expired" dan status_kode == 2)
        } elseif ($status === 'expired' && $statusCode == 2) {
            if ($order->status !== 'canceled') {
                $order->update(['status' => 'canceled']);
            }
            Log::info('Order Expired', ['order_number' => $merchantRef]);
            
        // Status PENDING (status == "pending" dan status_kode == 0)
        } elseif ($status === 'pending' && $statusCode == 0) {
            // Biarkan status tetap pending, tidak perlu update DB jika memang defaultnya sudah pending
            Log::info('Order Still Pending', ['order_number' => $merchantRef]);
        
        // Status Lain (Misal Gagal/Error Lainnya)
        } else {
            // Jika ada status lain yang tidak terduga, log saja
            Log::warning('Unrecognized Payment Status Logic', ['status' => $status, 'status_code' => $statusCode, 'order' => $merchantRef]);
        }

        // Balas dengan Success agar SakuRupiah tahu callback diterima
        return response()->json(['success' => true]);
    }
}