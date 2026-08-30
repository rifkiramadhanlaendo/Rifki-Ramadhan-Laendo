<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">Daftar Produk Kami</h2>

            <!-- Tombol Tambah Produk -->
            <div class="mb-6">
                <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md font-semibold hover:bg-blue-700 shadow">
                    + Tambah Produk
                </a>
            </div>

            <!-- Notifikasi Pesan Sukses -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Grid Daftar Produk -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="bg-white p-5 rounded-lg shadow-md border border-gray-200">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-3">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-md text-gray-500 mb-3">
                                Tidak Ada Gambar
                            </div>
                        @endif

                        <h3 class="text-lg font-bold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ $product->description }}</p>
                        <p class="text-indigo-600 font-bold text-base">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-gray-500 text-xs mt-1 mb-4">Stok: {{ $product->stock }}</p>

                        <!-- Tombol Beli -->
                        <a href="/keranjang" class="block w-full text-center bg-red-600 hover:bg-red-700 text-white py-2 rounded-md font-semibold mb-2">
                            Beli Sekarang
                        </a>

                        <!-- Tombol Edit -->
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="block w-full text-center bg-yellow-500 hover:bg-yellow-600 text-white py-2 rounded-md font-semibold mb-2">
                            Edit Produk
                        </a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-700 hover:bg-red-800 text-white py-2 rounded-md font-semibold">
                                Hapus Produk
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-gray-500 py-6">Belum ada produk yang ditambahkan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>