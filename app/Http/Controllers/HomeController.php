<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Halaman Home / Beranda
    public function index()
    {
        return view('index'); // atau template.index
    }

    // Halaman Deskripsi Produk / Detail
    public function description($id)
    {
        // $id digunakan untuk mengambil data produk berdasarkan ID
        return view('products.index'); 
    }

    // Halaman Daftar Order / Keranjang Pembeli
    public function orderList()
    {
        return view('cart'); 
    }
}