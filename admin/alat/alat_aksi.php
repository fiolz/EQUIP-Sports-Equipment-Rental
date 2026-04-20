<?php 
include '../../koneksi.php';

session_start();

// Cek apakah yang akses sudah login dan apakah levelnya Admin
if($_SESSION['level'] != "admin"){
    header("location:../../login.php?pesan=gagal");
    exit();
}

$nama    = $_POST['nama_alat'];
$desc    = $_POST['deskripsi'];
$stok    = $_POST['stok'];
$harga   = $_POST['harga_per_hari'];

// Logika Upload Gambar
$foto_nama = $_FILES['foto']['name'];
$foto_tmp  = $_FILES['foto']['tmp_name'];
$folder    = "../../assets/img/" . $foto_nama; // Sesuaikan folder gambar lo

if(move_uploaded_file($foto_tmp, $folder)) {
    // Simpan ke database
    // Pastikan urutan VALUES sesuai dengan urutan di PHPMyAdmin lo!
    // Contoh: id, nama, deskripsi, stok, harga, foto
    $query = mysqli_query($koneksi, "INSERT INTO alat VALUES('', '$nama', '$desc', '$stok', '$harga', '$foto_nama')");
    
    if($query) {
        echo "<script>alert('Alat Berhasil Ditambah!'); window.location='alat_tampil.php';</script>";
    } else {
        echo "Gagal Simpan ke DB: " . mysqli_error($koneksi);
    }
} else {
    echo "Gagal Upload Gambar!";
}
?>