<?php

use Illuminate\Support\Facades\Route;

// Halaman Gabungan Sekali Jalan
Route::get('/', function () {
    return view('index');
});