<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - E-Commerce</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f4f4; }
        h1 { color: #333; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 400px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        label { display: block; margin-top: 10px; font-weight: bold; color: #555; }
        input { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { background: #38a169; color: white; border: none; padding: 10px 15px; margin-top: 15px; border-radius: 5px; cursor: pointer; font-weight: bold; width: 100%; }
        button:hover { background: #2f855a; }
    </style>
</head>
<body>
    <h1>Halaman Checkout Pembayaran</h1>
    
    <form>
        <label>Nama Lengkap:</label>
        <input type="text" placeholder="Masukkan nama Anda">
        
        <label>Alamat Pengiriman:</label>
        <input type="text" placeholder="Masukkan alamat lengkap">
        
        <label>Nomor Telepon:</label>
        <input type="text" placeholder="Masukkan nomor HP/WhatsApp">

        <button type="submit">Konfirmasi Pesanan</button>
    </form>
    
    <p style="margin-top: 20px;"><a href="/cart">&larr; Kembali ke Keranjang</a></p>
</body>
</html>