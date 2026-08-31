<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; // Pastikan menggunakan Category

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil jumlah produk
        $jumlahProduk = Product::count();

        // Mengambil jumlah kategori produk (gunakan Category::count())
        $jumlahKategori = Category::count();

        // Mengambil jumlah klik produk
        $jumlahKlikProduk = Product::sum('click');

        // Kirim data ke view dashboard
        return view('dashboard', compact(
            'jumlahProduk',
            'jumlahKategori',
            'jumlahKlikProduk'
        ));
    }
}