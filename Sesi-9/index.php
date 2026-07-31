<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'connect.php';

try {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Gagal memuat produk: " . $e->getMessage());
}

$page_title = "Katalog Toko Online";
include_once 'product/template/header.php';
include_once 'product/template/navbar.php';
?>

<main class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-bold text-dark m-0">✨ Katalog Toko Online</h1>
            <p class="text-muted m-0">Klik produk untuk melihat detail atau langsung checkout</p>
        </div>
        <div>
            <a href="product/index.php" class="btn btn-dark fw-bold px-3 py-2 rounded-3 shadow-sm">
                ⚙️ Panel Admin CRUD
            </a>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $prod): ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden d-flex flex-column transition-card">
                        <div class="bg-light text-center overflow-hidden" style="height: 180px;">
                            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=500" class="w-100 h-100" style="object-fit: cover;" alt="Produk">
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between p-4 flex-grow-1">
                            <div>
                                <span class="badge bg-secondary mb-2 px-2 py-1"><?php echo htmlspecialchars($prod['category'] ?? 'Umum'); ?></span>
                                <h5 class="card-title fw-bold text-dark text-truncate mb-2"><?php echo htmlspecialchars($prod['name']); ?></h5>
                                <p class="card-text text-primary fw-bold fs-5 mb-3">Rp <?php echo number_format($prod['price'], 0, ',', '.'); ?></p>
                            </div>
                            
                            <div class="d-grid gap-2 mt-2">
                                <a href="detail_product.php?id=<?php echo $prod['id']; ?>" class="btn btn-outline-primary fw-bold py-2 rounded-3">
                                    Lihat Detail
                                </a>
                                <a href="checkout.php?direct_id=<?php echo $prod['id']; ?>" class="btn btn-success fw-bold py-2 rounded-3">
                                    ⚡ Checkout Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">Belum ada produk yang tersedia di database.</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<style>
    .transition-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .transition-card:hover {
        transform: translateY(-5px);
        box-shadow: .5rem 1rem rgba(0,0,0,.15)!important;
    }
</style>

<?php include_once 'product/template/footer.php'; ?>