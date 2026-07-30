<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

try {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        header("Location: index.php");
        exit;
    }

    $order_stmt = $pdo->query("SELECT * FROM orders ORDER BY id DESC LIMIT 5");
    $orders = $order_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $orders = [];
}

$page_title = "Detail - " . htmlspecialchars($product['name']);
include_once 'product/template/header.php';
include_once 'product/template/navbar.php';
?>

<main class="container my-5">
    <div class="mb-4">
        <a href="index.php" class="btn btn-outline-secondary fw-semibold">&larr; Kembali ke Katalog</a>
    </div>

    <div class="card shadow-sm border-0 bg-white rounded-3 p-4 mb-5">
        <div class="row">
            <div class="col-md-5 text-center">
                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600" class="img-fluid rounded shadow-sm" alt="Produk">
            </div>
            <div class="col-md-7">
                <span class="badge bg-secondary mb-2"><?php echo htmlspecialchars($product['category'] ?? 'Umum'); ?></span>
                <h1 class="fw-bold text-dark"><?php echo htmlspecialchars($product['name']); ?></h1>
                <h3 class="text-primary fw-bold my-3">Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></h3>
                <p class="text-muted"><?php echo nl2br(htmlspecialchars($product['description'] ?? 'Tidak ada deskripsi.')); ?></p>
                <p class="fw-semibold">Stok: <?php echo $product['stock']; ?> pcs</p>
                
                <div class="mt-4">
                    <a href="cart_action.php?action=add&id=<?php echo $product['id']; ?>" class="btn btn-outline-primary px-4 fw-bold me-2">🛒 +Keranjang</a>
                    <a href="checkout.php?direct_id=<?php echo $product['id']; ?>" class="btn btn-primary px-4 fw-bold">Beli Sekarang</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Transaksi -->
    <div class="card shadow-sm border-0 bg-white rounded-3 p-4">
        <h4 class="fw-bold mb-4">📋 Riwayat Transaksi Terbaru</h4>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nama Pemesan</th>
                        <th>Alamat</th>
                        <th>Metode Pembayaran</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $ord): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($ord['nama']); ?></td>
                                <td><?php echo htmlspecialchars($ord['alamat']); ?></td>
                                <td><?php echo htmlspecialchars($ord['metode_pembayaran']); ?></td>
                                <td class="fw-bold text-primary">Rp <?php echo number_format($ord['total_price'], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">Belum ada riwayat pesanan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include_once 'product/template/footer.php'; ?>