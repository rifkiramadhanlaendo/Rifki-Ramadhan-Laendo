<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form checkout.php
    $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telepon = isset($_POST['telepon']) ? trim($_POST['telepon']) : '';
    $alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';
    $metode = isset($_POST['metode_pembayaran']) ? trim($_POST['metode_pembayaran']) : '';
    $catatan = isset($_POST['catatan']) ? trim($_POST['catatan']) : '-';
    $total_price = isset($_POST['total_price']) ? intval($_POST['total_price']) : 0;
    $direct_id = isset($_POST['direct_id']) ? intval($_POST['direct_id']) : 0;

    if (!empty($nama) && !empty($alamat) && !empty($telepon)) {
        try {
            // 1. Simpan pesanan ke database MySQL (tabel orders)
            // Pastikan kolom email, telepon, catatan sudah ada di tabel orders
            $stmt = $pdo->prepare("INSERT INTO orders (nama, email, telepon, alamat, metode_pembayaran, catatan, total_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nama, $email, $telepon, $alamat, $metode, $catatan, $total_price]);

            // Ambil nama produk jika dibeli langsung via tombol checkout produk
            $nama_produk = "Pesanan Produk dari Katalog";
            if ($direct_id > 0) {
                $p_stmt = $pdo->prepare("SELECT name FROM products WHERE id = ?");
                $p_stmt->execute([$direct_id]);
                $prod = $p_stmt->fetch(PDO::FETCH_ASSOC);
                if ($prod) {
                    $nama_produk = $prod['name'];
                }
            }

            // Hapus sesi keranjang jika ada
            unset($_SESSION['cart']);

            // 2. NOMOR WHasApp PENJUAL (Ganti dengan nomor WhatsApp kamu, format pakai 62 tanpa tanda +)
            // Contoh: 08123456789 jadi 628123456789
            $nomor_whatsapp_penjual = "6282399114997"; 

            // 3. Rangkai Pesan Teks untuk WhatsApp
            $pesan = "Halo Kak, saya ingin konfirmasi pesanan baru:%0a%0a" .
                     "👤 *Nama:* " . urlencode($nama) . "%0a" .
                     "📧 *Email:* " . urlencode($email) . "%0a" .
                     "📞 *No. Telepon:* " . urlencode($telepon) . "%0a" .
                     "🛍️ *Produk/Detail:* " . urlencode($nama_produk) . "%0a" .
                     "💰 *Total Bayar:* Rp " . number_format($total_price, 0, ',', '.') . "%0a" .
                     "💳 *Metode Pembayaran:* " . urlencode($metode) . "%0a" .
                     "📍 *Alamat Pengiriman:* " . urlencode($alamat) . "%0a" .
                     "📝 *Catatan:* " . urlencode($catatan) . "%0a%0a" .
                     "Mohon segera diproses ya Kak. Terima kasih!";

            // 4. Lempar (Redirect) otomatis ke link WhatsApp Web/App
            $url_wa = "https://wa.me/{$nomor_whatsapp_penjual}?text={$pesan}";
            header("Location: " . $url_wa);
            exit;

        } catch (PDOException $e) {
            die("Gagal memproses pesanan ke database: " . $e->getMessage());
        }
    }
}

// Kalau diakses tidak lewat tombol submit, kembalikan ke katalog
header("Location: index.php");
exit;