<?php
include 'koneksi.php';

$id_user = 1; 
$username = 'admin'; //customize this username (silahkan ganti username ini sesuai keinginan Anda)
$password = '123456'; //customize this password (silahkan ganti password ini sesuai keinginan Anda)
$hash = password_hash($password, PASSWORD_DEFAULT);

$role = 'admin';
$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hash, $role);
$stmt->execute();

 header('Location: index.php');
