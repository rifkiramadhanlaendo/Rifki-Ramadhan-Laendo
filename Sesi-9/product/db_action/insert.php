<?php
require_once '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $price = intval($_POST['price']);
    $stock = intval($_POST['stock']);
    $description = trim($_POST['description']);

    if (!empty($name) && $price > 0) {
        try {
            $stmt = $pdo->prepare("INSERT INTO products (name, category, price, stock, description) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $category, $price, $stock, $description]);
            header("Location: ../index.php");
            exit;
        } catch (PDOException $e) {
            die("Gagal menambah produk: " . $e->getMessage());
        }
    }
}
header("Location: ../create.php");
exit;