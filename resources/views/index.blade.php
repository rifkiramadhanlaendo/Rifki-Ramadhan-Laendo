<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama - Toko Online Saya</title>
</head>
<body style="margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; color: #333; display: flex; flex-direction: column; min-height: 100vh;">

    <!-- Memanggil Komponen Navbar -->
    @include('components.navbar')

    <!-- Hero Section / Bagian Utama -->
    <div style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
        <div style="background: linear-gradient(135deg, #ffffff 0%, #f9fbfb 100%); padding: 50px 40px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); max-width: 700px; width: 100%; text-align: center; border: 1px solid #e1e8ed;">
            <span style="background-color: #e3f2fd; color: #1976d2; padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Selamat Datang</span>
            <h1 style="color: #1a202c; font-size: 32px; margin: 20px 0 10px 0; font-weight: 700;">Pusat Belanja Online Terbaik & Terpercaya</h1>
            <p style="color: #64748b; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">Temukan berbagai produk berkualitas pilihan dengan penawaran menarik hanya untuk Anda di toko kami.</p>
            
            <div style="display: flex; gap: 15px; justify-content: center;">
                <a href="/produk" style="background-color: #2563eb; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: 600; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);">Lihat Daftar Produk</a>
                <a href="https://wa.me/6282399114997?text=Halo,%20saya%20tertarik%20dengan%20produk%20di%20website%20Anda" 
                target="_blank" 
                style="background-color: #22c55e; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: 600;">
                Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Memanggil Komponen Footer -->
    @include('components.footer')

</body>
</html>