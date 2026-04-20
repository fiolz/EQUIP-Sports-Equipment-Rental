<?php 
session_start();
include '../../koneksi.php';

if(isset($_POST['update'])){
    $id             = $_POST['id_alat'];
    $nama           = mysqli_real_escape_string($koneksi, $_POST['nama_alat']);
    $id_kategori    = $_POST['id_kategori'];
    $harga_per_hari = $_POST['harga_per_hari'];
    $stok           = $_POST['stok'];
    $deskripsi      = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $min_pinjam     = $_POST['min_pinjam'];

    // 1. Ambil data foto baru (kalau ada)
    $foto_nama = $_FILES['foto']['name'];
    $foto_tmp  = $_FILES['foto']['tmp_name'];
    $folder    = "../../assets/img/";

    // 2. Cek: Apakah user upload foto baru?
    if(!empty($foto_nama)){
        // Jika upload foto baru:
        $nama_foto_baru = time() . "_" . $foto_nama; // Kasih nama unik
        move_uploaded_file($foto_tmp, $folder . $nama_foto_baru);

        // Update database TERMASUK kolom gambar
        $sql = "UPDATE alat SET 
                nama_alat       = '$nama', 
                id_kategori     = '$id_kategori', 
                harga_per_hari  = '$harga_per_hari', 
                stok            = '$stok', 
                deskripsi       = '$deskripsi',
                min_pinjam      = '$min_pinjam',
                gambar          = '$nama_foto_baru'
                WHERE id_alat   = '$id'";
    } else {
        // Jika TIDAK upload foto baru, update data lain saja (gambar tetap yang lama)
        $sql = "UPDATE alat SET 
                nama_alat       = '$nama', 
                id_kategori     = '$id_kategori', 
                harga_per_hari  = '$harga_per_hari', 
                stok            = '$stok', 
                deskripsi       = '$deskripsi',
                min_pinjam      = '$min_pinjam'
                WHERE id_alat   = '$id'";
    }

    $query = mysqli_query($koneksi, $sql);

    if($query){
        echo "<script>alert('Data Berhasil Diupdate!'); window.location='alat_tampil.php';</script>";
    } else {
        echo "Gagal Update: " . mysqli_error($koneksi);
    }
}
?>