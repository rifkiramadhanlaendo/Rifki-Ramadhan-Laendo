<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <p class="text-gray-600 text-sm mt-1">You're logged in! Kelola toko online dan pesanan Anda dengan mudah</p>
            </div>

            <!-- Grid Kartu Ringkasan Tugas Sesi-18 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Card 1: Jumlah Produk (Biru) -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 shadow-sm">
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Jumlah Produk</p>
                    <p class="text-4xl font-bold text-gray-900">{{ $jumlahProduk }}</p>
                    <p class="text-xs text-gray-500 mt-2">Total produk yang tersedia di sistem.</p>
                </div>

                <!-- Card 2: Jumlah Klik Produk (Hijau) -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 shadow-sm">
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Jumlah Klik Produk</p>
                    <p class="text-4xl font-bold text-gray-900">{{ $jumlahKlikProduk }}</p>
                    <p class="text-xs text-gray-500 mt-2">Total klik pada produk yang telah dilihat pengguna.</p>
                </div>

                <!-- Card 3: Jumlah Kategori Produk (Krem/Kuning) -->
                <div class="bg-amber-50 border border-amber-200 rounded-lg p-6 shadow-sm">
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wider">Jumlah Kategori Produk</p>
                    <p class="text-4xl font-bold text-gray-900">{{ $jumlahKategori }}</p>
                    <p class="text-xs text-gray-500 mt-2">Total kategori produk yang tersedia di sistem.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>