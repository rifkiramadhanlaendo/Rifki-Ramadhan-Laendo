<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hubungkan ke database
require_once '../connect.php';

// ==========================================
// 1. PROSES UPDATE STATUS ATAU HAPUS PESANAN
// ==========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $status_baru = trim($_POST['status_baru']); 

    try {
        // JIKA PILIH BATAL -> MAKA HAPUS DATA SECARA PERMANEN
        if ($status_baru === 'Batal') {
            // Hapus detail item terlebih dahulu
            $stmt_delete_items = $pdo->prepare("DELETE FROM order_items WHERE order_id = ?");
            $stmt_delete_items->execute([$order_id]);

            // Baru hapus data order utamanya
            $stmt_delete_order = $pdo->prepare("DELETE FROM orders WHERE id = ?");
            $stmt_delete_order->execute([$order_id]);

            $_SESSION['msg_success'] = "Pesanan #$order_id telah dibatalkan dan dihapus permanen!";
        } else {
            // JIKA PILIH STATUS LAIN -> UPDATE STATUS DI DATABASE
            $stmt_update = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
            $stmt_update->execute([$status_baru, $order_id]);
            
            $_SESSION['msg_success'] = "Status pesanan #$order_id berhasil diperbarui menjadi $status_baru!";
        }
    } catch (PDOException $e) {
        $_SESSION['msg_error'] = "Gagal memproses perubahan: " . $e->getMessage();
    }
    header("Location: index.php");
    exit;
}

// ==========================================
// 2. AMBIL DATA PESANAN & DETAIL PRODUKNYA
// ==========================================
try {
    $query = "SELECT * FROM orders ORDER BY id DESC";
    $stmt = $pdo->query($query);
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $query_details = "SELECT od.*, p.name AS nama_produk 
                      FROM order_items od 
                      JOIN products p ON od.product_id = p.id";
    $stmt_details = $pdo->query($query_details);
    $all_details = $stmt_details->fetchAll(PDO::FETCH_ASSOC);

    $order_items = [];
    foreach ($all_details as $detail) {
        $order_items[$detail['order_id']][] = $detail;
    }

} catch (PDOException $e) {
    die("Gagal mengambil data pesanan: " . $e->getMessage());
}

$page_title = "Daftar Pesanan Masuk - Rifki Store";
include_once '../product/template/header.php';
?>

<main class="container-fluid my-5 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold text-dark mb-1">Dashboard Pesanan</h1>
            <p class="text-muted mb-0">Pantau detail belanjaan, kontak pelanggan, dan perbarui status transaksi.</p>
        </div>
        <a href="../index.php" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke Toko</a>
    </div>

    <!-- Notifikasi Flash Message -->
    <?php if (isset($_SESSION['msg_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show fw-semibold" role="alert">
            <?php echo $_SESSION['msg_success']; unset($_SESSION['msg_success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['msg_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show fw-semibold" role="alert">
            <?php echo $_SESSION['msg_error']; unset($_SESSION['msg_error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0 bg-white">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="table-orders" class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 60px;">ID</th>
                            <th>Tanggal Pesan</th>
                            <th>Nama Pelanggan</th>
                            <th>Kontak</th>
                            <th>Metode</th>
                            <th class="text-end">Total Bayar</th>
                            <th class="text-center" style="width: 150px;">Status Pesanan</th>
                            <th class="text-center" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($orders)): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada pesanan masuk saat ini.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($orders as $order): ?>
                                <?php 
                                    // Deteksi status murni dari database
                                    $status_sekarang = trim($order['status'] ?? 'Pending'); 
                                    
                                    // Pilihan warna background dropdown sesuai status aktif
                                    $bg_badge = 'bg-warning text-dark';
                                    if ($status_sekarang === 'Diproses') $bg_badge = 'bg-primary text-white';
                                    if ($status_sekarang === 'Selesai') $bg_badge = 'bg-success text-white';
                                    if ($status_sekarang === 'Batal') $bg_badge = 'bg-danger text-white';
                                ?>
                                <tr>
                                    <td class="text-center fw-bold text-secondary">#<?php echo $order['id']; ?></td>
                                    <td>
                                        <span class="small text-dark fw-semibold">
                                            <?php echo isset($order['created_at']) ? date('d M Y H:i', strtotime($order['created_at'])) : (isset($order['tanggal']) ? $order['tanggal'] : '-'); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?php echo htmlspecialchars($order['nama_lengkap'] ?? $order['nama'] ?? '-'); ?></div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border"><?php echo htmlspecialchars($order['no_telp'] ?? $order['telepon'] ?? '-'); ?></span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border fw-semibold">
                                            <?php echo htmlspecialchars($order['metode_pembayaran'] ?? $order['metode'] ?? '-'); ?>
                                        </span>
                                    </td>
                                    <td class="text-end fw-bold text-primary">
                                        Rp <?php echo number_format($order['total_harga'] ?? $order['total'] ?? 0, 0, ',', '.'); ?>
                                    </td>
                                    
                                    <!-- Form Update Status Instan (VALUE DIUBAH MENJADI TEKS MURNI TANPA EMOJI) -->
                                    <td class="text-center">
                                        <form action="" method="POST">
                                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                            <select name="status_baru" class="form-select form-select-sm fw-semibold <?php echo $bg_badge; ?>" onchange="this.form.submit()">
                                                <option value="Pending" <?php echo ($status_sekarang === 'Pending') ? 'selected' : ''; ?>>⏳ Pending</option>
                                                <option value="Diproses" <?php echo ($status_sekarang === 'Diproses') ? 'selected' : ''; ?>>📦 Diproses</option>
                                                <option value="Selesai" <?php echo ($status_sekarang === 'Selesai') ? 'selected' : ''; ?>>✅ Selesai</option>
                                                <option value="Batal" <?php echo ($status_sekarang === 'Batal') ? 'selected' : ''; ?>>❌ Batal</option>
                                            </select>
                                            <input type="hidden" name="update_status" value="1">
                                        </form>
                                    </td>
                                    
                                    <!-- Tombol Detail & WhatsApp -->
                                    <td class="text-center">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <button type="button" class="btn btn-sm btn-info text-white fw-semibold" data-bs-toggle="modal" data-bs-target="#modalDetail<?php echo $order['id']; ?>">
                                                👁️ Detail
                                            </button>

                                            <?php 
                                            $telp_pelanggan = $order['no_telp'] ?? $order['telepon'] ?? '';
                                            $clean_telp = preg_replace('/[^0-9]/', '', $telp_pelanggan);
                                            if (strpos($clean_telp, '0') === 0) { $clean_telp = '62' . substr($clean_telp, 1); }
                                            ?>
                                            <?php if (!empty($clean_telp)): ?>
                                                <a href="https://api.whatsapp.com/send?phone=<?php echo $clean_telp; ?>&text=Halo%20Kak%20,%20kami%20dari%20Rifki%20Store%20ingin%20mengonfirmasi%20mengenai%20pesanan%20Anda%20 dengan%20status%20*<?php echo $status_sekarang; ?>*." target="_blank" class="btn btn-sm btn-success fw-semibold">
                                                    💬 WA
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Detail Pesanan -->
                                <div class="modal fade" id="modalDetail<?php echo $order['id']; ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content text-start">
                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title fw-bold">Detail Pesanan #<?php echo $order['id']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <small class="text-muted d-block">Alamat Pengiriman:</small>
                                                    <span class="fw-semibold text-dark"><?php echo htmlspecialchars($order['alamat_lengkap'] ?? $order['alamat'] ?? '-'); ?></span>
                                                </div>
                                                <div class="mb-3">
                                                    <small class="text-muted d-block">Email Pelanggan:</small>
                                                    <span class="fw-semibold text-dark"><?php echo htmlspecialchars($order['email'] ?? '-'); ?></span>
                                                </div>
                                                
                                                <hr>
                                                
                                                <h6 class="fw-bold text-secondary mb-2">Item Produk:</h6>
                                                <ul class="list-group list-group-flush mb-3">
                                                    <?php if (isset($order_items[$order['id']])): ?>
                                                        <?php foreach ($order_items[$order['id']] as $item): ?>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                                <div>
                                                                    <div class="fw-bold text-dark"><?php echo htmlspecialchars($item['nama_produk']); ?></div>
                                                                    <small class="text-muted"><?php echo $item['quantity'] ?? $item['qty']; ?> x Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></small>
                                                                </div>
                                                                <span class="fw-bold text-secondary">Rp <?php echo number_format(($item['quantity'] ?? $item['qty']) * $item['price'], 0, ',', '.'); ?></span>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <li class="list-group-item text-muted px-0 small">Detail produk tidak ditemukan/kosong.</li>
                                                    <?php endif; ?>
                                                </ul>

                                                <div class="bg-light p-3 rounded d-flex justify-content-between align-items-center">
                                                    <span class="fw-bold">Total Pembayaran:</span>
                                                    <span class="fs-5 fw-bold text-primary">Rp <?php echo number_format($order['total_harga'] ?? $order['total'] ?? 0, 0, ',', '.'); ?></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include_once '../product/template/footer.php'; ?>