<?php 
include '../../koneksi.php';

session_start();
include '../../koneksi.php'; // Naik 2 tingkat karena lo di sub-folder

if($_SESSION['level'] != "admin") { header("location:../../login.php"); }

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM users WHERE id_user='$id'");

header("location:user_tampil.php");
?>