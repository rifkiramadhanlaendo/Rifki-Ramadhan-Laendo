<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

   public function create()
    {
        $categories = Category::all();
        return view('products.tambah', compact('categories')); // Ubah bagian ini
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('products')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products')->with('success', 'Produk berhasil dihapus!');
    }

    public function store(Request $request)
{
    // Validasi input data produk
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string', 'max:255'],
        'price' => ['required', 'string', 'max:255'],
        'category_id' => ['required', 'max:255'],
        'image' => ['required', 'mimes:jpg,png,jpeg', 'max:2048'],
        'stock' => ['required', 'string', 'max:255'],
    ]);

    // Cari kategori berdasarkan ID yang dipilih
    $product_category = Category::find($request->category_id);

    // Simpan data produk baru ke database
    $product = new Product();
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->category_id = $product_category->id;
    
    // Menyimpan file gambar ke folder storage/app/public
    $product->image = $request->file('image')->store('public');
    
    $product->stock = $request->stock;
    $product->save();               

    // Arahkan kembali ke halaman index produk setelah berhasil
    return redirect()->route('admin.products.index');
}
}