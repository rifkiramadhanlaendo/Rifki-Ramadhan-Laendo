<?php
require_once 'connect.php'; 

$name = "Jersey";
$price = 150000;
$description = "A jersey is a soft, stretchy shirt worn by athletes or made from knitted fabric.";
$image = "Jersey.jpg";
$stock = "10";
$category = "Fashion";

$sql = "INSERT INTO products (name, price, description, image, stock, category) 
        VALUES (:name, :price, :description, :image, :stock, :category)";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':price' => $price,
        ':description' => $description,
        ':image' => $image,
        ':stock' => $stock,
        ':category' => $category
    ]);

    echo "<h1>Sukses Besar! Data 'Jersey' berhasil masuk database tugas sesi 6.</h1>";
    echo "<p>Silakan cek phpMyAdmin Anda sekarang!</p>";

} catch (\PDOException $e) {
    echo "<h1>Waduh, Eror Database:</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?>