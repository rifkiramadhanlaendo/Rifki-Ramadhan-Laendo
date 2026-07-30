<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'connect.php';

$cart_items = [];
$total_price = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    try {
        $stmt = $pdo->query("SELECT * FROM products WHERE id IN ($ids)");
        $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $cart_items = [];
    }
}

$page_title = "Keranjang Belanja";
include_once 'product/template/header.php';
include_once 'product/template/navbar.php';
?>

<main class="container my-5">
    <h2 class="fw-bold mb-4">🛒 Keranjang Belanja Anda</h2>

    <?php if (!empty($cart_items)): ?>
        <div class="card shadow-sm border-0 p-4">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): 
                        $qty = $_SESSION['cart'][$item['id']] ?? 1;
                        $subtotal = $item['price'] * $qty;
                        $total_price += $subtotal;
                    ?>
                        <tr>
                            <td class="fw-bold"><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                            <td><?php echo $qty; ?></td>
                            <td class="text-primary fw-bold">Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                            <td>
                                <a href="cart_action.php?action=remove&id=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                <h4 class="fw-bold m-0">Total: Rp <?php echo number_format($total_price, 0, ',', '.'); ?></h4>
                <a href="checkout.php" class="btn btn-success btn-lg fw-bold px-5">Lanjut ke Checkout</a>
            </div>
        </div>
    <?php else: ?>
        <div class="text-center py-5 bg-white rounded shadow-sm">
            <p class="text-muted fs-5 mb-3">Keranjang belanja kamu masih kosong.</p>
            <a href="index.php" class="btn btn-primary fw-bold px-4">Belanja Sekarang</a>
        </div>
    <?php endif; ?>
</main>

<?php include_once 'product/template/footer.php'; ?>