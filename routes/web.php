<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/produk', [ProductController::class, 'produk']);
Route::get('/keranjang', [ProductController::class, 'keranjang']);