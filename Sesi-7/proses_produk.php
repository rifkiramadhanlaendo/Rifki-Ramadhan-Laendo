<?php
session_start();

// Pastikan data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // 1. Sanitasi dan Validasi Input Teks/Angka
    $name        = isset($_POST['name']) ? trim(htmlspecialchars($_POST['name'])) : '';
    $description = isset($_POST['description']) ? trim(htmlspecialchars($_POST['description'])) : '';
    $price       = isset($_POST['price']) ? filter_var($_POST['price'], FILTER_VALIDATE_INT) : false;
    $stock       = isset($_POST['stock']) ? filter_var($_POST['stock'], FILTER_VALIDATE_INT) : false;
    $category    = isset($_POST['category']) ? trim($_POST['category']) : '';

    // Cek Nama
    if (empty($name)) {
        $errors[] = "Nama produk wajib diisi.";
    }

    // Cek Deskripsi
    if (empty($description)) {
        $errors[] = "Deskripsi produk wajib diisi.";
    }

    // Cek Harga
    if ($price === false || $price < 0) {
        $errors[] = "Harga harus berupa angka dan tidak boleh negatif.";
    }

    // Cek Stok
    if ($stock === false || $stock < 0) {
        $errors[] = "Stok harus berupa angka dan tidak boleh negatif.";
    }

    // Cek Kategori (Wajib Diisi dan Valid)
    $valid_categories = ['Elektronik', 'Pakaian', 'Makanan', 'Fotografi'];
    if (empty($category)) {
        $errors[] = "Kategori wajib dipilih.";
    } elseif (!in_array($category, $valid_categories)) {
        $errors[] = "Kategori yang dipilih tidak valid.";
    }

    // 2. Validasi File Gambar (Image)
    if (!isset($_FILES['image']) || $_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors[] = "Gambar produk wajib diunggah.";
    } else {
        $file        = $_FILES['image'];
        $fileName    = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize    = $file['size'];
        $fileError   = $file['error'];

        // Cek error bawaan upload PHP
        if ($fileError !== 0) {
            $errors[] = "Terjadi kesalahan saat mengunggah gambar.";
        }

        // Cek Ekstensi File (Menggunakan Mime Type agar lebih aman)
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (file_exists($fileTmpName)) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $fileTmpName);
            finfo_close($finfo);

            if (!in_array($mimeType, $allowedTypes)) {
                $errors[] = "Format gambar harus berupa JPG, JPEG, atau PNG.";
            }
        }

        // Cek Ukuran File (Maksimal 2MB = 2.097.152 bytes)
        if ($fileSize > 2097152) {
            $errors[] = "Ukuran gambar terlalu besar. Maksimal adalah 2MB.";
        }
    }

    // 3. Proses Akhir Pengolahan Data
    if (!empty($errors)) {
        // Jika ada error, simpan ke session dan lempar kembali ke form
        $_SESSION['errors'] = $errors;
        header("Location: form-produk.php");
        exit();
    } else {
        // Proses upload file jika validasi lolos
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        // Membuat nama unik baru untuk menghindari file tertimpa
        $newFileName = uniqid('prod_', true) . '.' . $fileExt;
        
        // Tentukan folder tujuan upload (pastikan folder 'uploads' sudah dibuat)
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($fileTmpName, $uploadDir . $newFileName)) {
            
            /* 
               DI SINI ANDA BISA MEMASUKKAN DATA KE DATABASE
               Contoh query:
               INSERT INTO products (name, description, price, stock, category, image) 
               VALUES ('$name', '$description', '$price', '$stock', '$category', '$newFileName');
            */

            $_SESSION['success'] = "Produk <strong>" . $name . "</strong> dengan kategori <strong>" . $category . "</strong> berhasil disimpan!";
            header("Location: form-produk.php");
            exit();
        } else {
            $_SESSION['errors'] = ["Gagal memindahkan file gambar ke server."];
            header("Location: form-produk.php");
            exit();
        }
    }
} else {
    // Jika mencoba akses langsung tanpa POST, tendang balik ke form
    header("Location: form-produk.php");
    exit();
}