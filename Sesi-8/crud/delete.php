<?php
require_once 'connect.php';

$productId = 1;
$sql = "DELETE FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $productId]);
echo "Product deleted successfully!";
?>