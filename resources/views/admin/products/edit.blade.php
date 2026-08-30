<x-app-layout>
    <div style="padding: 40px 0;">
        <div style="max-width: 800px; margin: 0 auto; padding: 0 20px; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <h2 style="font-size: 24px; font-weight: bold; margin-bottom: 24px; color: #1f2937;">Edit Produk</h2>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Produk -->
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 6px; color: #374151;">Name</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;" required>
                </div>

                <!-- Kategori -->
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 6px; color: #374151;">Category</label>
                    <select name="category_id" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; background: white; box-sizing: border-box;" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Deskripsi -->
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 6px; color: #374151;">Description</label>
                    <textarea name="description" rows="4" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Stok -->
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 6px; color: #374151;">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;" required>
                </div>

                <!-- Price -->
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 6px; color: #374151;">Price</label>
                    <input type="text" name="price" value="{{ old('price', $product->price) }}" style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box;" required>
                </div>

                <!-- Image -->
                <div style="margin-bottom: 24px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 6px; color: #374151;">Image</label>
                    @if($product->image)
                        <div style="margin-bottom: 8px;">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px;">
                        </div>
                    @endif
                    <input type="file" name="image" style="width: 100%; padding: 8px; border: 1px solid #d1d5db; border-radius: 6px; background: #f9fafb;">
                    <small style="color: #6b7280; display: block; margin-top: 4px;">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                </div>

                <!-- Tombol Aksi (Cancel & Simpan Perubahan) -->
                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <a href="{{ route('admin.products.index') }}" style="background-color: #9ca3af; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold;">
                        Cancel
                    </a>
                    <button type="submit" style="background-color: #2563eb; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>