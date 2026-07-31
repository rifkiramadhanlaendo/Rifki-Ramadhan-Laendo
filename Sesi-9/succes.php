<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page_title = "Pesanan Berhasil";
include_once 'product/template/header.php';
include_once 'product/template/navbar.php';
?>

<main class="container my-5 text-center" style="max-width: 600px;">
    <div class="card shadow-sm border-0 p-5">
        <div class="mb-4 text-success display-1">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <h2 class="fw-bold mb-3">Pesanan Berhasil Dibuat!</h2>
        <p class="text-muted mb-4">Terima kasih telah berbelanja di toko kami. Pesanan kamu sedang diproses oleh sistem.</p>
        <div>
            <a href="index.php" class="btn btn-primary fw-bold px-5 py-2">Kembali ke Katalog</a>
        </div>
    </div>
</main>

<?php include_once 'product/template/footer.php'; ?>