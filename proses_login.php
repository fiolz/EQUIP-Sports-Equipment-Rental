<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']); // Mengubah input password jadi MD5

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);
    
    // Simpan data ke session
    $_SESSION['username'] = $username;
    $_SESSION['level']    = $data['level'];
    $_SESSION['nama']     = $data['nama_lengkap'];
    $_SESSION['id_user']  = $data['id_user'];

    // Cek level dan arahkan ke folder masing-masing
    if ($data['level'] == "admin") {
        header("location:admin/dashboard.php");
    } else if ($data['level'] == "petugas") {
        header("location:petugas/dashboard.php");
    } else if ($data['level'] == "peminjam") {
        header("location:peminjam/dashboard.php");
    }
} else {
    echo "<script>alert('Login Gagal! Username atau Password salah'); window.location='login.php';</script>";
}
?>