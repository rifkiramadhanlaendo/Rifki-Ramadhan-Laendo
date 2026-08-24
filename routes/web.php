<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductCategoryController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard Umum (Untuk user biasa yang sudah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Halaman Publik (Produk, Keranjang, Order)
Route::get('/products', [ProductController::class, 'index'])->name('products');

// Route untuk Produk (Admin)
Route::get('/admin/products/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/admin/products', [ProductController::class, 'store'])->name('product.store');

// Route untuk Kategori Produk (Admin)
Route::get('/admin/product-categories/create', [CategoryController::class, 'create'])->name('product-category.create');
Route::post('/admin/product-categories', [CategoryController::class, 'store'])->name('product-category.store');
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

// Route Khusus Admin (Wajib Login & Ber-role Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Menggunakan ProductController yang benar
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    
    // Tambahan Route Kategori Produk (Sesi 20)
    Route::get('/product-category/create', [ProductCategoryController::class, 'create'])->name('product-category.create');
    Route::post('/product-category', [ProductCategoryController::class, 'store'])->name('product-category.store');
});

require __DIR__.'/auth.php';