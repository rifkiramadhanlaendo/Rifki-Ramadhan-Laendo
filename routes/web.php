<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman Produk (Terhubung ke ProductController)
Route::get('/products', [ProductController::class, 'index'])->name('products');

// Halaman Keranjang
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

// Halaman Order / Pesanan
Route::get('/orders', function () {
    return view('orders');
})->name('orders');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';