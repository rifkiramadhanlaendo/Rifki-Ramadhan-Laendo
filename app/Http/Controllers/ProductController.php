<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari tabel products di database
        $products = Product::all();

        // Mengirim data produk ke halaman view products.blade.php
        return view('products', compact('products'));
    }
}