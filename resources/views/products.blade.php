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
                <a href="{{ route('admin.products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md font-semibold hover:bg-blue-700">
                    + Tambah Produk
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
                        
                        <!-- Gambar hanya akan dirender jika ada file fotonya di database -->
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-md mb-4">
                        @endif

                        <h3 class="text-lg font-bold text-red-600">{{ $product->name }}</h3>
                        <p class="text-gray-600 mt-2 text-sm">{{ $product->description }}</p>
                        <p class="mt-4 font-bold text-gray-900 text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        
                        <button class="mt-4 w-full bg-red-600 text-white py-2 rounded-md font-semibold hover:bg-red-700">
                            Beli Sekarang
                        </button>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-white rounded-lg shadow">
                        <p class="text-gray-500 text-lg">Belum ada produk yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>