<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'Rainsta_DB_Ekspedisi_29';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die('Koneksi gagal: ' . $conn->connect_error);
?>
