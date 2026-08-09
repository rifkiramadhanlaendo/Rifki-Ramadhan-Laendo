<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-red-700 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Member Area</span>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-red-50 via-white to-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border-t-4 border-red-600">
                <div class="p-8 text-gray-900">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 bg-red-600 text-white rounded-lg shadow-md">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Selamat Datang Kembali!</h3>
                            <p class="text-gray-600 mt-1">You're logged in! Kelola toko online dan pesanan Anda dengan mudah di RRL Group.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>