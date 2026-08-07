<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('index');
});

Route::get('/produk', [ProductController::class, 'index']);

// Tambahkan baris ini agar halaman keranjang tidak 404
Route::get('/keranjang', function () {
    return view('cart'); // Pastikan file cart.blade.php ada di resources/views/
});