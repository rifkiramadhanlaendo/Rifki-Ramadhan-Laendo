<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'connect.php';

$direct_id = isset($_GET['direct_id']) ? intval($_GET['direct_id']) : 0;
$product_detail = null;
$total_tagihan = 0;

if ($direct_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$direct_id]);
    $product_detail = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($product_detail) {
        $total_tagihan = $product_detail['price'];
    }
} else {
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $id => $qty) {
            $stmt = $pdo->prepare("SELECT price FROM products WHERE id = ?");
            $stmt->execute([$id]);
            $p = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($p) {
                $total_tagihan += $p['price'] * $qty;
            }
        }
    }
}

$page_title = "Formulir Checkout Pesanan";
include_once 'product/template/header.php';
include_once 'product/template/navbar.php';
?>

<main class="container my-5" style="max-width: 750px;">
    <div class="mb-4">
        <a href="index.php" class="btn btn-outline-secondary fw-semibold">&larr; Kembali ke Katalog</a>
    </div>

    <div class="card shadow-sm border-0 p-5 rounded-3 bg-white">
        <h2 class="fw-bold mb-4 text-dark">📝 Form Checkout & Pengiriman</h2>

        <?php if ($product_detail): ?>
            <div class="alert alert-light border mb-4 d-flex align-items-center">
                <div>
                    <span class="badge bg-primary mb-1">Beli Langsung</span>
                    <h5 class="fw-bold text-dark m-0"><?php echo htmlspecialchars($product_detail['name']); ?></h5>
                    <small class="text-muted">Harga: Rp <?php echo number_format($product_detail['price'], 0, ',', '.'); ?></small>
                </div>
            </div>
        <?php endif; ?>

        <form action="process_checkout.php" method="POST">
            <input type="hidden" name="direct_id" value="<?php echo $direct_id; ?>">
            <input type="hidden" name="total_price" value="<?php echo $total_tagihan; ?>">

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap Penerima</label>
                <input type="text" name="nama" class="form-control" placeholder="Contoh: Rifki Pratama" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Alamat Email</label>
                    <input type="email" name="email" class="form-control" placeholder="contoh@email.com" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Nomor Telepon / WhatsApp</label>
                    <input type="tel" name="telepon" class="form-control" placeholder="081234567890" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Alamat Lengkap Pengiriman</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Jalan, Nomor Rumah, RT/RW, Kecamatan, Kota, Kode Pos" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Metode Pembayaran</label>
                <select name="metode_pembayaran" class="form-select" required>
                    <option value="" disabled selected>-- Pilih Metode Pembayaran --</option>
                    <option value="Transfer Bank BCA">Transfer Bank BCA</option>
                    <option value="Transfer Bank Mandiri">Transfer Bank Mandiri</option>
                    <option value="Transfer Bank BNI">Transfer Bank BNI</option>
                    <option value="E-Wallet (GoPay / OVO / Dana)">E-Wallet (GoPay / OVO / Dana)</option>
                    <option value="COD (Bayar di Tempat)">COD (Bayar di Tempat)</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Catatan Pesanan (Opsional)</label>
                <textarea name="catatan" class="form-control" rows="2" placeholder="Catatan khusus untuk kurir atau penjual..."></textarea>
            </div>

            <div class="alert alert-secondary py-3 mb-4 d-flex justify-content-between align-items-center">
                <span class="fw-bold fs-5 text-dark m-0">Total Pembayaran:</span>
                <span class="fw-bold fs-4 text-primary m-0">Rp <?php echo number_format($total_tagihan, 0, ',', '.'); ?></span>
            </div>

            <button type="submit" class="btn btn-success w-100 fw-bold py-3 rounded-3 shadow-sm">
                Konfirmasi & Buat Pesanan Sekarang
            </button>
        </form>
    </div>
</main>

<?php include_once 'product/template/footer.php'; ?>