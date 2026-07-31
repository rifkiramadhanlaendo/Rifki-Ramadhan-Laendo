<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return view('products');
});

Route::get('/cart', function () {
    return view('cart'); // Menghubungkan ke cart.blade.php
});

Route::get('/checkout', function () {
    return view('checkout'); // Menghubungkan ke checkout.blade.php
});