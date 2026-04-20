<?php 
include '../../koneksi.php';

session_start();

// Cek apakah yang akses sudah login dan apakah levelnya Admin
if($_SESSION['level'] != "admin"){
    header("location:../../login.php?pesan=gagal");
    exit();
}

// Menangkap data 'nama_kategori' dari form
$nama = $_POST['nama_kategori'];

// Perintah SQL untuk memasukkan data
$query = mysqli_query($koneksi, "INSERT INTO kategori VALUES('', '$nama')");

if($query){
    // Jika berhasil, balikkan ke halaman tampil
    header("location:kategori_tampil.php");
} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>