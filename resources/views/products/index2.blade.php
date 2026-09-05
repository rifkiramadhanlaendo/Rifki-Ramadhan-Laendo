<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Toko Online Saya</title>
</head>
<body style="margin: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fafc; color: #1e293b; display: flex; flex-direction: column; min-height: 100vh;">

    <!-- Memanggil Komponen Navbar -->
    @include('components.navbar')

    <!-- Konten Utama Daftar Produk -->
    <div style="flex: 1; padding: 40px 20px; max-width: 1200px; margin: 0 auto; width: 100%;">
        
        <div style="margin-bottom: 30px; text-align: center;">
            <h1 style="color: #0f172a; font-size: 30px; margin-bottom: 10px; font-weight: 800;">Daftar Produk Pilihan</h1>
            <p style="color: #64748b; font-size: 15px; margin: 0;">Pilih produk berkualitas dengan penawaran terbaik dari toko kami.</p>
        </div>
        
        <!-- Grid Produk -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px;">
            @foreach($products as $product)
                <div style="background: #ffffff; border: 1px solid #e2e8f0; padding: 20px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); display: flex; flex-direction: column; justify-content: space-between; transition: transform 0.2s, box-shadow 0.2s;">
                    <div>
                        <div style="background-color: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; display: inline-block; margin-bottom: 10px;">
                            Stok: {{ $product['stock'] }}
                        </div>
                        <h3 style="margin: 0 0 8px 0; color: #1e293b; font-size: 18px; font-weight: 700;">{{ $product['name'] }}</h3>
                        <p style="color: #64748b; font-size: 13px; line-height: 1.5; margin: 0 0 20px 0;">{{ $product['description'] }}</p>
                    </div>
                    
                    <a href="https://wa.me/6282399114997?text=Halo,%20saya%20tertarik%20dengan%20produk%20di%20website%20Anda" 
                    target="_blank" 
                    style="background-color: #22c55e; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; font-weight: 600;">
                    Hubungi via WhatsApp
                    </a>
                </div>
            @endforeach
        </div>

    </div>

    <!-- Memanggil Komponen Footer -->
    @include('components.footer')

</body>
</html>