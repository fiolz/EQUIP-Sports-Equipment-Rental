<?php 
include '../../koneksi.php';

session_start();

// Cek apakah yang akses sudah login dan apakah levelnya Admin
if($_SESSION['level'] != "admin"){
    header("location:../../login.php?pesan=gagal");
    exit();
}

// Menangkap data id yang dikirim dari URL
$id = $_GET['id'];

// Menghapus data dari database
mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$id'");

// Alihkan halaman kembali ke kategori_tampil.php
header("location:kategori_tampil.php");
?>