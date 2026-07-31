DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS products;

-- 2. TABEL PRODUK
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. TABEL ORDERS (Sudah ditambahkan kolom status)
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    no_telp VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    alamat_lengkap TEXT NOT NULL,
    metode_pembayaran VARCHAR(50) NOT NULL,
    status VARCHAR(30) DEFAULT 'Pending', -- INI YANG KITA TAMBAHKAN
    total_harga INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. TABEL DETAIL ITEM ORDER
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    price INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE, -- Biar kalau dihapus/batal otomatis bersih
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE RESTRICT
);