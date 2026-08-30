<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    // Menampilkan halaman tambah produk
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Menyimpan data produk baru (Sesi 21)
    public function store(Request $request)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price'       => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'max:255'],
            'image'       => ['required', 'mimes:jpg,png,jpeg', 'max:2048'],
            'stock'       => ['required', 'string', 'max:255'],
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;

        // Menyimpan file gambar
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product successfully created!');
    }

    // Menampilkan halaman edit produk (Sesi 22)
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // Memproses update data produk (Sesi 22)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price'       => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'max:255'],
            'image'       => ['nullable', 'mimes:jpg,png,jpeg', 'max:2048'],
            'stock'       => ['required', 'string', 'max:255'],
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->stock = $request->stock;

        // Jika ada upload gambar baru, hapus gambar lama lalu simpan yang baru
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product successfully updated!');
    }

    // Menghapus data produk berdasarkan ID (Sesi 22)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->back()
            ->with('success', 'Product has successfully deleted!');
    }
}