<?php
include 'koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO pengiriman (id_user, nama_pengirim, nama_penerima, alamat_tujuan, berat, tanggal_kirim, id_kurir, status) VALUES (?, ?, ?, ?, ?, NOW(), ?, 'Diambil')");
    $stmt->bind_param('isssdi', $_SESSION['id_user'], $_POST['nama_pengirim'], $_POST['nama_penerima'], $_POST['alamat'], $_POST['berat'], $_POST['id_kurir']);
    $stmt->execute();
    $success = 'Pengiriman berhasil diinput';
}

$kurir = $conn->query("SELECT * FROM kurir");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Input Pengiriman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Form Input Pengiriman</h3>
    <?php if (isset($success)): ?>
        <div class="alert alert-success"> <?= $success ?> </div>
    <?php endif; ?>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label class="form-label">Nama Pengirim</label>
            <input name="nama_pengirim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Penerima</label>
            <input name="nama_penerima" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat Tujuan</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Berat Paket (kg)</label>
            <input name="berat" type="number" step="0.1" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kurir</label>
            <select name="id_kurir" class="form-select" required>
                <?php while($k = $kurir->fetch_assoc()): ?>
                <option value="<?= $k['id_kurir'] ?>"><?= $k['nama_kurir'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
