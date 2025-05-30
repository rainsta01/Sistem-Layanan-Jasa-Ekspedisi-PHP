<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO status_pengiriman (id_pengiriman, status, waktu) VALUES (?, ?, NOW())");
    $stmt->bind_param('is', $_POST['id_pengiriman'], $_POST['status']);
    $stmt->execute();
    $conn->query("UPDATE pengiriman SET status = '{$_POST['status']}' WHERE id_pengiriman = {$_POST['id_pengiriman']}");
    $success = 'Status berhasil diupdate';
}

$pengiriman = $conn->query("SELECT id_pengiriman, nama_penerima FROM pengiriman ORDER BY tanggal_kirim DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Status Pengiriman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Update Status Pengiriman</h3>
    <?php if (isset($success)): ?>
        <div class="alert alert-success"> <?= $success ?> </div>
    <?php endif; ?>
    <form method="POST" class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Nomor Resi</label>
            <select name="id_pengiriman" class="form-select" required>
                <?php while ($p = $pengiriman->fetch_assoc()): ?>
                    <option value="<?= $p['id_pengiriman'] ?>">
                        <?= $p['id_pengiriman'] ?> - <?= $p['nama_penerima'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Status Baru</label>
            <select name="status" class="form-select" required>
                <option value="Diambil">Diambil</option>
                <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                <option value="Diterima">Diterima</option>
            </select>
        </div>
        <div class="col-md-4 align-self-end">
            <button type="submit" class="btn btn-primary w-100">Update Status</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
