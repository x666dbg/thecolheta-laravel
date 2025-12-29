<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // 1. API BUAT DASHBOARD STATS
    public function dashboardStats()
    {
        // Hitung Total Duit (Hanya yang statusnya bukan pending/canceled)
        // Sesuaikan status 'paid', 'processing', 'completed' sama logic bisnis lu
        $revenue = Order::whereIn('status', ['processing', 'completed', 'shipped', 'paid'])
            ->sum('total_price');

        // Hitung Total Order
        $totalOrders = Order::count();

        // Hitung Total Customer
        $totalCustomers = Customer::count();

        // Hitung Total Produk Terjual (Quantity di order items)
        // Kita butuh join ke order buat filter yang paid doang sebenernya, 
        // tapi biar cepet kita hitung semua dulu atau filter basic
        $productsSold = OrderItem::whereHas('order', function($q) {
            $q->whereIn('status', ['processing', 'completed', 'shipped', 'paid']);
        })->sum('quantity');

        // Ambil 5 Order Terbaru buat list kecil di dashboard
        $recentOrders = Order::with('customer')
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'revenue' => $revenue,
            'total_orders' => $totalOrders,
            'total_customers' => $totalCustomers,
            'products_sold' => $productsSold,
            'recent_orders' => $recentOrders
        ]);
    }

    // 2. API BUAT HALAMAN ORDERS (LIST SEMUA)
    public function allOrders(Request $request)
    {
        $query = Order::with(['customer', 'address', 'items']);

        // Filter Status (Optional, kalau frontend kirim ?status=pending)
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Search Invoice / Nama Customer
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($c) use ($search) {
                      $c->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->latest()->get(); // Atau ->paginate(10) kalo mau paging

        return response()->json($orders);
    }
}