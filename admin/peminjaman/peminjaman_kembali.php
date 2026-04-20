<?php 
session_start();
include '../../koneksi.php'; // Pastikan path benar

session_start();

// Cek apakah yang akses sudah login dan apakah levelnya Admin
if($_SESSION['level'] != "admin"){
    header("location:../../login.php?pesan=gagal");
    exit();
}

$id = $_GET['id'];

// 1. Ambil data peminjaman untuk tahu id_alat dan jumlahnya
$data = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_peminjaman='$id'");
$p    = mysqli_fetch_array($data);

$id_alat = $p['id_alat'];
$jumlah  = $p['jumlah'];

// 2. Tambah stok alat di tabel alat
mysqli_query($koneksi, "UPDATE alat SET stok = stok + $jumlah WHERE id_alat='$id_alat'");

// 3. Ubah status di tabel peminjaman menjadi 'kembali'
$query = mysqli_query($koneksi, "UPDATE peminjaman SET status='kembali' WHERE id_peminjaman='$id'");

if($query){
    echo "<script>alert('Barang dikembalikan! Stok bertambah.'); window.location='peminjaman_tampil.php';</script>";
}
?>