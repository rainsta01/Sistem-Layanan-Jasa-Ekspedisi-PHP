<?php
include 'koneksi.php';
session_start();
if ($_SESSION['role'] !== 'admin') die('Akses ditolak.');

if (isset($_POST['tambah'])) {
    $stmt = $conn->prepare("INSERT INTO kurir (nama_kurir, no_hp) VALUES (?, ?)");
    $stmt->bind_param('ss', $_POST['nama'], $_POST['no_hp']);
    $stmt->execute();
}

if (isset($_GET['hapus'])) {
    $stmt = $conn->prepare("DELETE FROM kurir WHERE id_kurir = ?");
    $stmt->bind_param('i', $_GET['hapus']);
    $stmt->execute();
}

$kurir = $conn->query("SELECT * FROM kurir ORDER BY nama_kurir");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manajemen Kurir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Manajemen Kurir</h3>
    <form method="POST" class="row g-3 mb-4">
        <div class="col-md-5">
            <input type="text" name="nama" class="form-control" placeholder="Nama Kurir" required>
        </div>
        <div class="col-md-5">
            <input type="text" name="no_hp" class="form-control" placeholder="Nomor HP" required>
        </div>
        <div class="col-md-2">
            <button type="submit" name="tambah" class="btn btn-primary w-100">Tambah</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kurir</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($k = $kurir->fetch_assoc()): ?>
            <tr>
                <td><?= $k['nama_kurir'] ?></td>
                <td><?= $k['no_hp'] ?></td>
                <td>
                    <a href="?hapus=<?= $k['id_kurir'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
