<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online - Semua Hasil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- 1. NAVBAR / HEADER -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">Toko-Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home/Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Deskripsi Product</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Order List</a></li>
                </ul>
                <div class="d-flex">
                    <a href="#" class="btn btn-outline-primary btn-sm me-2">Login</a>
                    <a href="#" class="btn btn-primary btn-sm">Registrasi</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- 2. KONTEN UTAMA -->
    <main class="container my-5 flex-grow-1">
        <div class="p-5 bg-white rounded-3 shadow-sm border">
            <h1 class="text-dark fw-bold mb-3">Selamat Datang di Toko Online!</h1>
            <p class="text-secondary fs-5">Semua tampilan halaman utama, navbar, dan footer sudah digabungkan di sini agar langsung bisa Anda lihat tanpa ribet.</p>
            
            <hr class="my-4">

            <h4 class="mb-3">Daftar Menu Admin (Simulasi):</h4>
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">- Dashboard Admin</a>
                <a href="#" class="list-group-item list-group-item-action">- CRUD Product</a>
                <a href="#" class="list-group-item list-group-item-action">- CRUD Product Category</a>
                <a href="#" class="list-group-item list-group-item-action">- Transaction Management</a>
            </div>
        </div>
    </main>

    <!-- 3. FOOTER -->
    <footer class="bg-white text-secondary text-center py-3 shadow-sm mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2026 Toko-Online. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>