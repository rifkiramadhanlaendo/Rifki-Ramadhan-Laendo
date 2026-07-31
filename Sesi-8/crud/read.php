<?php
require_once 'connect.php';

$sql = "SELECT * FROM products LIMIT 1";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
    echo "ID: " . $product['id'] . "<br>";
    echo "Name: " . $product['name'] . "<br>";
    echo "Price: " . $product['price'] . "<br>";
    echo "Description: " . $product['description'] . "<br>";
    echo "Stock: " . $product['stock'] . "<br>";
    echo "Category: " . $product['category'] . "<br>";
    echo "<hr>";
}
?>