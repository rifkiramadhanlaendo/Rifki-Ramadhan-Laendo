<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Mengambil data produk dengan relasi kategori dan pagination
        $products = Product::with('category')->paginate(5);

        return view('products.index', compact('products'));
    }
}