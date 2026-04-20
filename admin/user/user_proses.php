<?php 
include '../../koneksi.php';

session_start();
include '../../koneksi.php'; 

if($_SESSION['level'] != "admin") { header("location:../../login.php"); }

$nama     = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$level    = $_POST['level'];

$query = mysqli_query($koneksi, "INSERT INTO users (nama_lengkap, username, password, level) 
                                 VALUES ('$nama', '$username', '$password', '$level')");

if($query){
    header("location:user_tampil.php");
} else {
    echo "Gagal simpan user: " . mysqli_error($koneksi);
}
?>