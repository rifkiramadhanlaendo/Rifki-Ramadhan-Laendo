<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRL GROUP - Toko Online Terpercaya</title>
    <!-- Menggunakan Tailwind CSS CDN agar langsung aktif tanpa npm run dev -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans antialiased text-gray-800 m-0 p-0">

    <!-- NAVBAR -->
    <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">
            <div class="text-2xl font-black text-blue-600 tracking-wider">
                RRL GROUP
            </div>
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-blue-700 text-sm shadow-md">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-semibold text-sm">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:bg-blue-700 text-sm shadow-md">Daftar</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="bg-gradient-to-br from-blue-600 to-indigo-800 text-white py-24 px-6 text-center">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
                Selamat Datang di <span class="text-yellow-300">RRL Group</span>
            </h1>
            <p class="text-lg md:text-xl text-blue-100 mb-10 leading-relaxed">
                Pusat belanja online terpercaya dengan berbagai pilihan produk berkualitas tinggi untuk memenuhi segala kebutuhan Anda secara cepat dan praktis.
            </p>
            <a href="{{ route('products') }}" class="inline-block bg-yellow-400 hover:bg-yellow-300 text-gray-900 font-extrabold px-8 py-4 rounded-2xl shadow-xl transition transform hover:-translate-y-1 text-lg">
                🛍️ Jelajahi Produk Kami
            </a>
        </div>
    </section>

    <!-- KEUNGGULAN -->
    <section class="py-16 max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex items-start space-x-5">
                <div class="bg-blue-100 p-4 rounded-2xl text-blue-600 text-2xl">🚀</div>
                <div>
                    <h3 class="font-bold text-xl text-gray-900 mb-2">Pengiriman Cepat</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Pesanan dikemas dan dikirim langsung ke tujuan Anda dengan cepat dan aman.</p>
                </div>
            </div>
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex items-start space-x-5">
                <div class="bg-green-100 p-4 rounded-2xl text-green-600 text-2xl">🛡️</div>
                <div>
                    <h3 class="font-bold text-xl text-gray-900 mb-2">Produk Original</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Semua produk dijamin kualitas dan keasliannya dari sumber terpercaya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-400 py-8 text-center text-sm mt-20 border-t border-gray-800">
        <p>&copy; {{ date('Y') }} RRL Group. All rights reserved.</p>
    </footer>

</body>
</html>