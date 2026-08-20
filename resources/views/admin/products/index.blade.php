<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Daftar Produk</h2>
                    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">+ Tambah Produk</a>
                </div>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Gambar</th>
                                <th class="px-6 py-3">Nama Produk</th>
                                <th class="px-6 py-3">Kategori</th>
                                <th class="px-6 py-3">Stok</th>
                                <th class="px-6 py-3">Harga</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($products as $index => $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($product->image)
                                            <img src="{{ Str::startsWith($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}" width="50" class="rounded shadow object-cover">
                                        @else
                                            <span class="text-gray-400 text-xs">No Image</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->category->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->stock }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium flex justify-center gap-2 items-center">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold bg-indigo-50 px-3 py-1 rounded">Edit</a>
                                        
                                        <!-- Tombol Hapus (Wajib menggunakan form DELETE) -->
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-semibold bg-red-50 px-3 py-1 rounded">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>