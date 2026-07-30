<?php
require_once '../../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    
    // Ambil info file gambar
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
    $image_tmp = isset($_FILES['image']['tmp_name']) ? $_FILES['image']['tmp_name'] : '';

    // Validate the form data
    $errors = [];
    if (empty($name)) {
        $errors['name'] = 'Nama produk harus diisi.';
    }
    if (empty($category)) {
        $errors['category'] = 'Kategori produk harus diisi.';
    }
    if (empty($price) || !is_numeric($price) || $price < 0){
        $errors['price'] = 'Harga produk harus berupa angka positif.';
    }
    if (empty($stock) || !is_numeric($stock) || $stock < 0){
        $errors['stock'] = 'Stock produk harus berupa angka positif.';
    }

    // Jika ADA error (!empty), baru lempar balik ke form edit
    if (!empty($errors)) {
        session_start();
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $_POST;
        header('location: edit.php?id=' . $id);
        exit();
    }

    // Check if a new image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../../uploads/';
        $image = time() . '_' . basename($image); // Rename untuk menghindari bentrok nama
        $image_path = $upload_dir . $image;
        move_uploaded_file($image_tmp, $image_path);

        // Delete the old image if it exists
        $sql = "SELECT image FROM products WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $oldImage = $stmt->fetchColumn();
        if ($oldImage && file_exists($upload_dir . $oldImage)) {
            unlink($upload_dir . $oldImage);
        }

        // Update dengan mengganti gambar baru
        $sql = "UPDATE products SET name = :name, category = :category, price = :price, stock = :stock, description = :description, image = :image WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':category' => $category,
            ':price' => $price,
            ':stock' => $stock,
            ':description' => $description,
            ':image' => $image,
            ':id' => $id
        ]);
    } else {
        // Update TANPA mengubah gambar lama (Parameter :image dihapus dari query & array)
        $sql = "UPDATE products SET name = :name, category = :category, price = :price, stock = :stock, description = :description WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':category' => $category,
            ':price' => $price,
            ':stock' => $stock,
            ':description' => $description,
            ':id' => $id
        ]);
    }

    // Redirect ke halaman daftar produk setelah sukses
    header('Location: ../index.php');
    exit();
}