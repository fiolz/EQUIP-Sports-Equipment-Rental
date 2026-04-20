<?php 
include '../../koneksi.php';
session_start();

// 1. Proteksi Halaman Admin
if($_SESSION['level'] != "admin"){
    header("location:../../login.php?pesan=gagal");
    exit();
}

// 2. Cek apakah form sudah dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Tangkap data teks
    $nama      = mysqli_real_escape_string($koneksi, $_POST['nama_alat']);
    $kat       = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
    $harga     = mysqli_real_escape_string($koneksi, $_POST['harga_per_hari']);
    $stok      = mysqli_real_escape_string($koneksi, $_POST['stok']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $min       = mysqli_real_escape_string($koneksi, $_POST['min_pinjam']);

    // --- LOGIKA UPLOAD GAMBAR (TAMBAHKAN INI) ---
    $foto_nama = $_FILES['foto']['name'];
    $foto_tmp  = $_FILES['foto']['tmp_name'];
    $folder    = "../../assets/img/";

    // Pindahkan file fisik ke folder project
    move_uploaded_file($foto_tmp, $folder . $foto_nama);
    // --------------------------------------------

    // 3. Query Insert (WAJIB masukkan kolom 'gambar')
    $query = "INSERT INTO alat (nama_alat, id_kategori, harga_per_hari, stok, deskripsi, min_pinjam, gambar) 
              VALUES ('$nama', '$kat', '$harga', '$stok', '$deskripsi', '$min', '$foto_nama')";

    $hasil = mysqli_query($koneksi, $query);

    // 4. Cek Hasil
    if($hasil){
        header("location:alat_tampil.php?pesan=berhasil");
        exit();
    } else {
        die("Gagal simpan ke database: " . mysqli_error($koneksi));
    }

} else {
    header("location:alat_tambah.php");
    exit();
}
?>