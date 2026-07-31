<?php
require_once '../../connect.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $price = intval($_POST['price']);
    $stock = intval($_POST['stock']);
    $description = trim($_POST['description']);

    try {
        $stmt = $pdo->prepare("UPDATE products SET name = ?, category = ?, price = ?, stock = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $category, $price, $stock, $description, $id]);
        header("Location: ../index.php");
        exit;
    } catch (PDOException $e) {
        die("Gagal mengupdate produk: " . $e->getMessage());
    }
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header("Location: ../index.php");
    exit;
}

$page_title = "Edit Produk";
include_once '../template/header.php';
include_once '../template/navbar.php';
?>

<div class="container my-5" style="max-width: 600px;">
    <div class="card shadow-sm border-0 p-4">
        <h2 class="fw-bold mb-4">Edit Produk</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Produk</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kategori</label>
                <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($product['category']); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Harga (Rp)</label>
                <input type="number" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Stok</label>
                <input type="number" name="stock" class="form-control" value="<?php echo $product['stock']; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary fw-bold w-100 py-2">Simpan Perubahan</button>
        </form>
    </div>
</div>

<?php include_once '../template/footer.php'; ?>