<?php 
include '../../koneksi.php';

session_start();

// Cek apakah yang akses sudah login dan apakah levelnya Admin
if($_SESSION['level'] != "admin"){
    header("location:../../login.php?pesan=gagal");
    exit();
}


// Menangkap id_alat yang dikirim dari URL
$id = $_GET['id'];

// Menghapus data dari tabel alat berdasarkan id_alat
$query = mysqli_query($koneksi, "DELETE FROM alat WHERE id_alat='$id'");

if($query){
    // Balik lagi ke halaman tampil alat
    header("location:alat_tampil.php");
} else {
    echo "Gagal menghapus: " . mysqli_error($koneksi);
}
?>