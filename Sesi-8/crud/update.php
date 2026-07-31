<?php

require_once 'connect.php';

$productId = 1;
$newName = "Update Jersey";
$newPrice = "160000";
$newDescription = "An updated Keeps you cool and dry during intense matches or workouts.";
$newImage = "updated_Jersey.jpg";
$newStock = "15";
$sql = "UPDATE products SET name = :name, price = :price, description = :description, image = :image, stock = :stock WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':name' => $newName,
    ':price' => $newPrice,
    ':description' => $newDescription,
    ':image' => $newImage,
    ':stock' => $newStock,
    ':id' => $productId
]);
echo "Product updated succesfully!";
?>