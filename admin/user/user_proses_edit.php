<?php 
include '../../koneksi.php';

session_start();
include '../../koneksi.php';

if($_SESSION['level'] != "admin") { header("location:../../login.php"); }

$id       = $_POST['id_user'];
$nama     = $_POST['nama'];
$username = $_POST['username'];
$level    = $_POST['level'];

$query = mysqli_query($koneksi, "UPDATE users SET 
                                 nama_lengkap='$nama', 
                                 username='$username', 
                                 level='$level' 
                                 WHERE id_user='$id'");

if($query){
    header("location:user_tampil.php");
} else {
    echo "Gagal update user: " . mysqli_error($koneksi);
}
?>