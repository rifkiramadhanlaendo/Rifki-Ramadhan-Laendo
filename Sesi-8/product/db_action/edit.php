<?php
include_once '../template/header.php';
require_once '../../crud/connect.php';

// Mengambil ID produk dari URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id)) {
    echo "Product not found!";
    include_once '../template/footer.php';
    exit;
}

// AMBIL DATA MENGGUNAKAN METODE PDO
$query = "SELECT * FROM products WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found!";
    include_once '../template/footer.php';
    exit;
}
?>

<main class="container my-5">
    <h1>Edit Produk</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

    <form action="update.php" method="POST" enctype="multipart/form-data">
        <!-- Input Hidden ID Produk (Sangat Krusial) -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
            <select class="form-select" id="category" name="category" required>
                <option value="">-- Pilih kategori --</option>
                <option value="Asia" <?php echo ($product['category'] == 'Asia') ? 'selected' : ''; ?>>Asia</option>
                <option value="Eropa" <?php echo ($product['category'] == 'Eropa') ? 'selected' : ''; ?>>Eropa</option>
                <option value="America latin" <?php echo ($product['category'] == 'America latin') ? 'selected' : ''; ?>>America latin</option>
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Produk (Kosongkan jika tidak diganti)</label>
            <input type="file" class="form-control" id="image" name="image">
            <small class="text-muted">Gambar saat ini: <?php echo htmlspecialchars($product['image']); ?></small>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="../index.php" class="btn btn-secondary">Batal</a>
    </form>
</main>

<?php include_once '../template/footer.php'; ?>