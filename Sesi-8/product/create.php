<?php
$page_title = "Tambah Produk - Rifki Store";
include_once 'template/header.php';
?>
<main class="container my-5">
    <h1 class="mb-4">Tambah Produk</h1>
    <form action="db_action/insert.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
            <select class="form-select" id="category" name="category" required>
                <option value="">-- Pilih kategori --</option>
                <option value="Asia">Asia</option>
                <option value="Eropa">Eropa</option>
                <option value="America latin">America latin</option>
            </select>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                <input type="number" step="1" class="form-control" id="price" name="price" placeholder="160000" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Stok <span class="text-danger">*</span></label>
                <input type="number" step="1" class="form-control" id="stock" name="stock" placeholder="10" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" row="3" placeholder="Deskripsi produk..."></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Produk</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </main>
<?php include_once 'template/footer.php'; ?>