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

// ==================== ROUTE KHUSUS ADMIN ====================
// Menggunakan Route::resource agar otomatis membuat rute: index, create, store, show, edit, update, destroy
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Rute Produk Admin (Otomatis menghasilkan admin.products.index, create, store, edit, update, destroy)
    Route::resource('products', ProductController::class);
    
    // Rute Kategori Admin
    Route::resource('categories', CategoryController::class);
    Route::resource('product-categories', ProductCategoryController::class);
});

require __DIR__.'/auth.php';