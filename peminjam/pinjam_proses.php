<?php
session_start();
include '../koneksi.php'; // Pastikan path ke koneksi.php bener

// Cek login biar gak disusupin
if($_SESSION['level'] != "peminjam"){
    header("location:../login.php?pesan=gagal");
    exit();
}

// 1. Ambil data dari form
$id_user     = $_SESSION['id_user'];
$id_alat     = $_POST['id_alat'];
$jumlah      = $_POST['jumlah'];
$tgl_pinjam  = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];

// 2. Logika Hitung Durasi (Penting buat validasi!)
$tgl1 = new DateTime($tgl_pinjam);
$tgl2 = new DateTime($tgl_kembali);
$jarak = $tgl2->diff($tgl1);
$durasi = $jarak->days;

// 3. Ambil data alat (Harga & Syarat Minimal) dari tabel alat
$query_alat = mysqli_query($koneksi, "SELECT * FROM alat WHERE id_alat='$id_alat'");
$data_alat  = mysqli_fetch_array($query_alat);
$harga_satuan = $data_alat['harga_per_hari'];
$min_sewa     = $data_alat['min_pinjam']; // Kolom yang barusan lo buat

// --- VALIDASI MINIMAL SEWA ---
if($durasi < $min_sewa) {
    echo "<script>
            alert('Gagal! Alat ".$data_alat['nama_alat']." minimal dipinjam ".$min_sewa." hari.');
            window.history.back();
          </script>";
    exit();
}

// Minimal sewa dihitung 1 hari kalau pinjam & balik di hari sama (untuk alat non-gym)
if($durasi == 0) { $durasi = 1; }

// 4. Hitung Total Harga
$total_harga = $durasi * $harga_satuan * $jumlah;

// 5. Simpan ke database
// Pastikan urutan kolom di tabel peminjaman lo pas
$sql = "INSERT INTO peminjaman VALUES ('', '$id_user', '$id_alat', '$tgl_pinjam', '$tgl_kembali', '$jumlah', '$total_harga', 'pending')";

$simpan = mysqli_query($koneksi, $sql);

if($simpan){
    echo "<script>alert('Berhasil Pinjam! Total Bayar: Rp ".number_format($total_harga, 0, ',', '.')."'); window.location='pinjaman_saya.php';</script>";
} else {
    echo "Error Database: " . mysqli_error($koneksi);
}
?>