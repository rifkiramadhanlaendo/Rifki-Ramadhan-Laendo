<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../connect.php';

try {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Gagal memuat data: " . $e->getMessage());
}

$page_title = "Manajemen Admin Produk";
include_once 'template/header.php';
include_once 'template/navbar.php';
?>

<main class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark m-0">🛠️ Manajemen Data Produk</h2>
        <a href="create.php" class="btn btn-success fw-bold px-4 rounded-3 shadow-sm">+ Tambah Produk</a>
    </div>

    <div class="card shadow-sm border-0 bg-white rounded-3 p-4">
        <div class="table-responsive">
            <table id="adminProductsTable" class="table table-striped table-hover align-middle w-100">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($products as $prod): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td class="fw-bold"><?php echo htmlspecialchars($prod['name']); ?></td>
                            <td><span class="badge bg-secondary"><?php echo htmlspecialchars($prod['category'] ?? 'Lain-lain'); ?></span></td>
                            <td class="text-success fw-bold">Rp <?php echo number_format($prod['price'], 0, ',', '.'); ?></td>
                            <td><?php echo $prod['stock']; ?> pcs</td>
                            <td class="text-center">
                                <a href="db_action/edit.php?id=<?php echo $prod['id']; ?>" class="btn btn-sm btn-warning text-white fw-semibold px-2 rounded-2 me-1">Edit</a>
                                <a href="db_action/delete.php?id=<?php echo $prod['id']; ?>" class="btn btn-sm btn-danger fw-semibold px-2 rounded-2" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include_once 'template/footer.php'; ?>