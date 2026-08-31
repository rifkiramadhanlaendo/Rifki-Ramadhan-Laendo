<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductCategoryController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard Umum (Sekarang sudah terhubung ke DashboardController agar datanya tidak error)
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Halaman Publik (Produk, Keranjang, Order)
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/cart', function () {
    return view('cart');
})->name('cart');
Route::get('/orders', function () {
    return view('orders');
})->name('orders');

// Route Profil User
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =================== ROUTE KHUSUS ADMIN ===================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Produk Admin
    Route::resource('products', ProductController::class);

    // Rute Kategori Admin
    Route::resource('categories', CategoryController::class);
    Route::resource('product-categories', ProductCategoryController::class);
});

require __DIR__.'/auth.php';