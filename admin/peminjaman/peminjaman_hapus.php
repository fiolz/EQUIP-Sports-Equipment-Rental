<?php 
session_start();
include '../../koneksi.php';

// Cek level biar gak ditembus orang iseng
if($_SESSION['level'] != "admin") { 
    header("location:../../login.php"); 
    exit();
}

$id = $_GET['id'];

// Eksekusi hapus data dari tabel peminjaman
$query = mysqli_query($koneksi, "DELETE FROM peminjaman WHERE id_peminjaman='$id'");

if($query){
    // Balik ke halaman tampil yang ada di folder yang sama
    echo "<script>alert('Data peminjaman berhasil dihapus!'); window.location='peminjaman_tampil.php';</script>";
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>