<?php

use Illuminate\Support\Facades\Route;

// HANYA INI SAJA ISINYA
Route::get('/', function () {
    return view('welcome');
});

// HAPUS SEMUA Route::prefix('api') DI SINI.
// KITA PINDAH KE routes/api.php