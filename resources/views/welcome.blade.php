<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RRL Group - Toko Online</title>

    <!-- Tailwind CSS (Breeze Asset) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div class="min-h-screen flex flex-col justify-between">
        
        <!-- Navbar Atas -->
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo / Nama Brand -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center space-x-3">
                            <span class="font-bold text-xl text-gray-900 tracking-wider">RRL GROUP</span>
                        </a>
                    </div>

                    <!-- Tombol Navigasi / Autentikasi -->
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-red-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-red-600">Log in</a>
                            
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-md shadow hover:bg-red-700 transition">Register</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Bagian Utama / Hero Section -->
        <main class="flex-grow flex items-center justify-center bg-white py-20 px-4">
            <div class="text-center max-w-3xl">
                <h1 class="text-4xl sm:text-5xl font-extrabold mb-6 text-gray-900 tracking-tight">Selamat Datang di RRL Group</h1>
                <p class="text-lg sm:text-xl text-gray-600 mb-8">Pusat belanja online terpercaya dengan berbagai produk pilihan berkualitas tinggi untuk kebutuhan Anda.</p>
                
                <div class="flex justify-center space-x-4">
                    <a href="{{ route('products') }}" class="px-6 py-3 bg-red-600 text-white font-bold rounded-lg shadow-lg hover:bg-red-700 transition">Lihat Produk</a>
                    <a href="{{ route('cart') }}" class="px-6 py-3 border border-red-600 text-red-600 font-bold rounded-lg hover:bg-red-50 transition">Keranjang Saya</a>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} RRL Group. All rights reserved.
        </footer>
    </div>
</body>
</html>