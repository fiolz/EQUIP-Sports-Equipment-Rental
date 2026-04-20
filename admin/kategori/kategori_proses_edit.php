<?php 
include '../../koneksi.php';

session_start();

// Cek apakah yang akses sudah login dan apakah levelnya Admin
if($_SESSION['level'] != "admin"){
    header("location:../../login.php?pesan=gagal");
    exit();
}

$id = $_POST['id_kategori'];
$nama = $_POST['nama_kategori'];

// Update data di database
$query = mysqli_query($koneksi, "UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori='$id'");

if($query){
    header("location:kategori_tampil.php");
} else {
    echo "Gagal update: " . mysqli_error($koneksi);
}
?>