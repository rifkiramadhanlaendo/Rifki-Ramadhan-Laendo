<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return view('products.index'); 
    }

    public function produk() {
        return view('products.index2'); 
    }

    public function keranjang() {
        return view('cart'); 
    }
}