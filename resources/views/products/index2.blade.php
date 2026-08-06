<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Toko Online</title>
</head>
<body style="margin: 0; font-family: Arial, sans-serif; background-color: #f9f9f9;">

    <!-- Memanggil Komponen Navbar -->
    @include('components.navbar')

    <div style="padding: 30px; max-width: 1000px; margin: auto;">
        <h1 style="color: #333; border-bottom: 2px solid #ddd; padding-bottom: 10px;">Daftar Produk Pilihan</h1>
        
        <div style="display: flex; gap: 20px; margin-top: 20px; flex-wrap: wrap;">
            <!-- Produk 1 -->
            <div style="background: white; border: 1px solid #ddd; padding: 15px; width: 250px; border-radius: 5px;">
                <h3>Laptop Gaming Pro</h3>
                <p style="color: #666;">Spesifikasi gahar untuk kerja dan gaming.</p>
                <p style="font-weight: bold; color: #27ae60;">Rp 12.500.000</p>
                <a href="/keranjang" style="background: #2980b9; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; display: inline-block;">Beli / Masuk Keranjang</a>
            </div>

            <!-- Produk 2 -->
            <div style="background: white; border: 1px solid #ddd; padding: 15px; width: 250px; border-radius: 5px;">
                <h3>Smartphone X</h3>
                <p style="color: #666;">Kamera jernih baterai tahan seharian.</p>
                <p style="font-weight: bold; color: #27ae60;">Rp 4.200.000</p>
                <a href="/keranjang" style="background: #2980b9; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; display: inline-block;">Beli / Masuk Keranjang</a>
            </div>

            <!-- Produk 3 -->
            <div style="background: white; border: 1px solid #ddd; padding: 15px; width: 250px; border-radius: 5px;">
                <h3>Headphone Bluetooth</h3>
                <p style="color: #666;">Suara jernih bass mantap anti bising.</p>
                <p style="font-weight: bold; color: #27ae60;">Rp 750.000</p>
                <a href="/keranjang" style="background: #2980b9; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; display: inline-block;">Beli / Masuk Keranjang</a>
            </div>
        </div>
    </div>

    <!-- Memanggil Komponen Footer -->
    @include('components.footer')

</body>
</html>