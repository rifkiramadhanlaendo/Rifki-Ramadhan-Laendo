<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman Produk
Route::get('/products', [ProductController::class, 'index'])->name('products');

// Halaman Keranjang
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

// Halaman Order / Pesanan
Route::get('/orders', function () {
    return view('orders');
})->name('orders');

// Route Profil (Wajib ada agar tombol profile.edit tidak error)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Admin (Sesi 16)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
});

require __DIR__.'/auth.php';