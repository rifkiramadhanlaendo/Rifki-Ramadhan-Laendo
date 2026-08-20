<x-app-layout>
    <div class="py-12 bg-gradient-to-br from-blue-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-3xl mx-auto px-6">
            <div class="bg-white shadow-xl rounded-xl p-8 border-t-4 border-blue-600">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Product</h2>

                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                        <select name="category_id" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Price</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Image</label>
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" width="80" class="rounded shadow">
                            </div>
                        @endif
                        <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg bg-gray-50">
                    </div>

                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</a>
                        <button type="submit" class="px-6 py-2 bg-blue-900 text-white font-semibold rounded-lg hover:bg-blue-800">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>