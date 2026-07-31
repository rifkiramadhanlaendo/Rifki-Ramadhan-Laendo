<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja - E-Commerce</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        h1 { color: #333; }
        .cart-box { background: white; padding: 20px; border-radius: 8px; margin-bottom: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .btn-checkout { background: #3182ce; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; font-weight: bold; }
        .btn-checkout:hover { background: #2b6cb0; }
    </style>
</head>
<body>
    <h1>Keranjang Belanja Anda</h1>
    
    <div class="cart-box">
        <h3>Laptop Gaming Pro</h3>
        <p>Jumlah: 1x</p>
        <p>Harga: Rp 15.000.000</p>
    </div>

    <a href="/checkout" class="btn-checkout">Lanjut ke Checkout</a>
    
    <p style="margin-top: 20px;"><a href="/products">&larr; Lanjut Belanja</a></p>
</body>
</html>