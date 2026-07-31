<?php
require_once '../../connect.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        die("Gagal menghapus produk: " . $e->getMessage());
    }
}

header("Location: ../index.php");
exit;