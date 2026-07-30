<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page_title = "Tambah Produk Baru";
include_once 'template/header.php';
include_once 'template/navbar.php';
?>

<div class="container my-5" style="max-width: 600px;">
    <div class="card shadow-sm border-0 p-4">
        <h2 class="fw-bold mb-4">Tambah Produk Baru</h2>
        <form action="db_action/insert.php" method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Produk</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kategori</label>
                <input type="text" name="category" class="form-control" placeholder="Contoh: Elektronik, Fashion">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Harga (Rp)</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Stok</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success fw-bold w-100 py-2">Simpan Produk</button>
        </form>
    </div>
</div>

<?php include_once 'template/footer.php'; ?>