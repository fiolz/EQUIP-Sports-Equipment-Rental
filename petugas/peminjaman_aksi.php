<?php 
include '../koneksi.php';
$id = $_GET['id'];
$status = $_GET['status'];

session_start();

// Cek apakah yang akses levelnya Petugas
if($_SESSION['level'] != "petugas"){
    header("location:../../login.php?pesan=gagal");
    exit();
}

if ($status == "disetujui") {
    // Ambil info buat ngurangin stok
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman='$id'"));
    $id_alat = $data['id_alat'];
    $jml = $data['jumlah'];
    
    // Potong stok alatnya
    mysqli_query($koneksi, "UPDATE alat SET stok = stok - $jml WHERE id_alat='$id_alat'");
}

// Update status peminjaman
mysqli_query($koneksi, "UPDATE peminjaman SET status='$status' WHERE id_peminjaman='$id'");

header("location:peminjaman_tampil.php");
?>