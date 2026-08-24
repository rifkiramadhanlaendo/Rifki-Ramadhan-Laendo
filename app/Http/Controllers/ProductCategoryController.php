<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function create()
    {
        return view('admin.product-category.create');
    }

    public function store(Request $request)
    {
        // Validasi input nama kategori
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // Cek apakah kategori dengan nama yang sama sudah ada
        $name_check = ProductCategory::where('name', $request->name)->exists();

        if ($name_check) {
            return redirect()->back()->withErrors(['Nama kategori sudah ada!']);
        } else {
            // Simpan ke database
            ProductCategory::create([
                'name' => $request->name,
            ]);

            return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
        }
    }
}