<?php
include 'koneksi.php';
session_start();

$status = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_pengiriman'];
    $stmt = $conn->prepare("SELECT * FROM status_pengiriman WHERE id_pengiriman = ? ORDER BY waktu DESC");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $status = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lacak Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Lacak Paket</h3>
    <form method="POST" class="mb-4">
        <div class="input-group">
            <input type="number" name="id_pengiriman" class="form-control" placeholder="Masukkan Nomor Resi" required>
            <button class="btn btn-primary">Lacak</button>
        </div>
    </form>

    <?php if ($status): ?>
        <ul class="list-group">
            <?php foreach ($status as $s): ?>
                <li class="list-group-item">
                    <strong><?= $s['status'] ?></strong> <br>
                    <small><?= $s['waktu'] ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <div class="alert alert-warning">Data tidak ditemukan.</div>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
