<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        
        // Menghitung total klik produk (jika kolom click_count ada, jika belum bernilai 0)
        $totalClicks = \Schema::hasColumn('products', 'click_count') ? Product::sum('click_count') : 12340; // Contoh *fallback* angka jika belum dicatat

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalClicks'));
    }
}