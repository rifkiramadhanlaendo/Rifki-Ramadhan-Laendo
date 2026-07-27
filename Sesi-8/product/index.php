<?php
// Hubungkan ke koneksi database
require_once '../crud/connect.php'; 

// 1. Tangkap input filter kategori dari URL (jika ada)
$filter_category = isset($_GET['category']) ? $_GET['category'] : '';

// 2. Tentukan Query SQL berdasarkan apakah ada filter yang dipilih atau tidak
if (!empty($filter_category)) {
    // Jika ada kategori yang dipilih, filter menggunakan WHERE
    $query = "SELECT * FROM products WHERE category = :category ORDER BY id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':category' => $filter_category]);
} else {
    // Jika tidak ada filter (Pilih Semua), tampilkan semua produk seperti biasa
    $query = "SELECT * FROM products ORDER BY id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
}

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<main class="container my-5">
    
    <div class="d-flex justify-content-between align-items-center my-3">
        <a href="create.php" class="btn btn-primary">Tambah Produk</a>
        
        <!-- FORM FILTER KATEGORI -->
        <form action="" method="GET" class="d-flex gap-2" style="max-width: 400px;">
            <select name="category" class="form-select">
                <option value="">-- Semua Kategori --</option>
                <!-- Menjaga agar opsi tetap 'selected' setelah halaman di-refresh -->
                <option value="Asia" <?php echo ($filter_category == 'Asia') ? 'selected' : ''; ?>>Asia</option>
                <option value="Eropa" <?php echo ($filter_category == 'Eropa') ? 'selected' : ''; ?>>Eropa</option>
                <option value="America latin" <?php echo ($filter_category == 'America latin') ? 'selected' : ''; ?>>America latin</option>
            </select>
            <button type="submit" class="btn btn-outline-secondary">Filter</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id']); ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                    <td><?php echo htmlspecialchars($product['description']); ?></td>
                    <td>
                        <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" width="100" alt="Foto Produk">
                    </td>
                    <td><?php echo htmlspecialchars($product['stock']); ?></td>
                    <td><?php echo htmlspecialchars($product['category']); ?></td>
                    <td>
                        <a href="db_action/edit.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="db_action/delete.php?id=<?php echo htmlspecialchars($product['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center text-muted">Tidak ada produk dalam kategori ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

</body>
</html>