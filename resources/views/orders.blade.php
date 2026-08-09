<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-red-700 leading-tight">
                {{ __('Daftar Order / Pesanan') }}
            </h2>
            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">RRL Group Store</span>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-red-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border-t-4 border-red-600">
                <div class="p-8 text-gray-900">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="p-3 bg-red-600 text-white rounded-lg shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Riwayat Pesanan Anda</h3>
                            <p class="text-sm text-gray-500">Berikut adalah daftar transaksi dan status pesanan aktif Anda.</p>
                        </div>
                    </div>

                    <div class="border-2 border-dashed border-red-200 rounded-xl p-8 text-center bg-red-50/50">
                        <p class="text-red-600 font-medium mb-2">Belum ada pesanan yang dibuat.</p>
                        <p class="text-sm text-gray-500 mb-4">Yuk, mulai belanja produk pilihan berkualitas tinggi di RRL Group!</p>
                        <a href="{{ route('products') }}" class="inline-block px-6 py-2.5 bg-red-600 text-white font-semibold rounded-lg shadow hover:bg-red-700 transition">Lihat Produk Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>