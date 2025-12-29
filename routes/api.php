<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --- IMPORT SEMUA CONTROLLER (LAMA & BARU) ---
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CartController;  // <-- Punya lu yg lama
use App\Http\Controllers\Api\OrderController; // <-- Yang baru buat SakuRupiah
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\AdminController; // <--- JANGAN LUPA IMPORT

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ===================================================
// 1. PUBLIC ROUTES (Gak perlu login)
// ===================================================

// Produk & Kategori (Biar user bisa liat katalog)
Route::apiResource('products', ProductController::class)->only(['index', 'show']);
Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

// Auth (Register & Login) - INI CODE LAMA LU
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/payment/notification', [PaymentController::class, 'handleCallback']); // GANTI NAMA ROUTE

// ===================================================
// 2. PROTECTED ROUTES (Harus Login / Pake Token)
// ===================================================
Route::middleware('auth:sanctum')->group(function () {

    // --- USER & LOGOUT (CODE LAMA LU) ---
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/profile', [AuthController::class, 'updateProfile']); // <--- BARU: Update Profile
    Route::put('/password', [AuthController::class, 'changePassword']); // <--- BARU: Ganti Password

    // --- KERANJANG / CART (CODE LAMA LU - GUA PERTAHANIN) ---
    // Gua balikin persis kayak logic lu di web.php tapi tanpa prefix 'api' lagi
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/add', [CartController::class, 'add']);
        Route::delete('/remove/{cartItem}', [CartController::class, 'remove']);
        Route::post('/update/{cartItem}', [CartController::class, 'updateQuantity']);
    });

    // --- CHECKOUT SAKURUPIAH (CODE BARU) ---
    Route::post('/checkout', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/payment/status/{orderNumber}', [PaymentController::class, 'checkStatus']); // <--- TAMBAH INI

    // --- ADMIN ROUTES (CODE LAMA LU - GUA PERTAHANIN) ---
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('products', ProductController::class)->except(['index', 'show']);
        Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
        Route::post('/products/{product}/toggle-status', [ProductController::class, 'toggleStatus']);
        Route::get('/admin/stats', [AdminController::class, 'dashboardStats']);
        Route::get('/admin/orders', [AdminController::class, 'allOrders']);
    });
});