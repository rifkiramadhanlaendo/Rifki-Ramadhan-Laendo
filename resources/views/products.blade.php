<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk Kami') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tombol Tambah Produk -->
            <div class="mb-6">
                <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold shadow hover:bg-blue-700 transition">
                    + Tambah Produk
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="bg-white p-6 rounded-lg shadow border border-gray-100 flex flex-col justify-between">
                        <div>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-md mb-4">
                            @endif

                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ $product->description }}</p>
                            <p class="text-indigo-600 font-semibold mb-4">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>

                        <div class="space-y-2">
                            <!-- Tombol Beli Sekarang -->
                            <a href="/keranjang" class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 rounded-md transition">
                                Beli Sekarang
                            </a>

                            <!-- Tombol Edit dan Hapus -->
                            <div class="flex gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="flex-1 text-center bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 rounded-md text-sm transition">
                                    Edit
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-gray-700 hover:bg-gray-800 text-white font-semibold py-2 rounded-md text-sm transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-8 text-gray-500">
                        Belum ada data produk.
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>