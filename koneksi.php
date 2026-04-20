<?php
$host = 'localhost';
$db   = 'db_peminjaman';
$user = 'root';
$pass = '';

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

?>