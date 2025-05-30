<?php
include 'koneksi.php';
session_start();

$pengiriman = $conn->prepare("SELECT * FROM pengiriman WHERE id_user = ? ORDER BY tanggal_kirim DESC");
$pengiriman->bind_param('i', $_SESSION['id_user']);
$pengiriman->execute();
$result = $pengiriman->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Riwayat Pengiriman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Riwayat Pengiriman</h3>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>No Resi</th>
                <th>Penerima</th>
                <th>Tujuan</th>
                <th>Berat</th>
                <th>Status</th>
                <th>Tanggal Kirim</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_pengiriman'] ?></td>
                <td><?= $row['nama_penerima'] ?></td>
                <td><?= $row['alamat_tujuan'] ?></td>
                <td><?= $row['berat'] ?> kg</td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['tanggal_kirim'] ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
