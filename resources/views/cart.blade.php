<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Toko Online</title>
</head>
<body style="margin: 0; font-family: Arial, sans-serif; background-color: #f9f9f9;">

    <!-- Memanggil Komponen Navbar -->
    @include('components.navbar')

    <div style="padding: 30px; max-width: 800px; margin: auto;">
        <h1 style="color: #333; border-bottom: 2px solid #ddd; padding-bottom: 10px;">Keranjang Belanja Anda</h1>
        
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background: white;">
            <thead>
                <tr style="background: #333; color: white; text-align: left;">
                    <th style="padding: 10px;">Produk</th>
                    <th style="padding: 10px;">Harga</th>
                    <th style="padding: 10px;">Jumlah</th>
                    <th style="padding: 10px;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px;">Smartphone X</td>
                    <td style="padding: 10px;">Rp 4.200.000</td>
                    <td style="padding: 10px;">1</td>
                    <td style="padding: 10px;">Rp 4.200.000</td>
                </tr>
                <tr style="border-bottom: 1px solid #ddd;">
                    <td style="padding: 10px;">Headphone Bluetooth</td>
                    <td style="padding: 10px;">Rp 750.000</td>
                    <td style="padding: 10px;">2</td>
                    <td style="padding: 10px;">Rp 1.500.000</td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 20px; text-align: right;">
            <h3>Total Pembayaran: <span style="color: #e74c3c;">Rp 5.700.000</span></h3>
            <button style="background: #27ae60; color: white; padding: 10px 20px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Checkout Sekarang</button>
        </div>
    </div>

    <!-- Memanggil Komponen Footer -->
    @include('components.footer')

</body>
</html>