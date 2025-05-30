<?php
session_start();
if (!isset($_SESSION['id_user'])) header('Location: index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
  </div>

  <div class="list-group">
    <a href="input_pengiriman.php" class="list-group-item list-group-item-action">Input Pengiriman</a>
    <a href="lacak_paket.php" class="list-group-item list-group-item-action">Lacak Paket</a>
    <a href="riwayat_pengiriman.php" class="list-group-item list-group-item-action">Riwayat Pengiriman</a>
    <?php if ($_SESSION['role'] == 'admin'): ?>
      <a href="manajemen_kurir.php" class="list-group-item list-group-item-action">Manajemen Kurir</a>
    <?php endif; ?>
    <a href="status_pengiriman.php" class="list-group-item list-group-item-action">Status Pengiriman</a>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
