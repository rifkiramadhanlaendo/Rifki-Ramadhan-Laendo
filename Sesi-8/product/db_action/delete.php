<?php
require_once '../../crud/connect.php';

// Pastikan ID produk ada di URL
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($id)) {
    try {
        $upload_dir = '../../uploads/';

        // 1. Cari nama file gambar produk lama terlebih dahulu
        $sql = "SELECT image FROM products WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            $image_name = $product['image'];
            
            // Hapus file fisik gambar di folder uploads jika file-nya ada
            if ($image_name && file_exists($upload_dir . $image_name)) {
                unlink($upload_dir . $image_name);
            }
        }

        // 2. Hapus data produk dari database
        $sql_delete = "DELETE FROM products WHERE id = :id";
        $stmt_delete = $pdo->prepare($sql_delete);
        $stmt_delete->execute([':id' => $id]);

        // Jika berhasil, lempar balik ke halaman utama produk
        header('Location: ../index.php');
        exit();

    } catch (PDOException $e) {
        // Jika ada error database, tampilkan pesannya
        echo "Gagal menghapus produk: " . $e->getMessage();
        exit();
    }
} else {
    // Jika tidak ada ID, langsung balik ke halaman utama
    header('Location: ../index.php');
    exit();
}