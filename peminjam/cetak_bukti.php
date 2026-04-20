<?php 
session_start();
include '../koneksi.php';

$id_pinjam = $_GET['id'];

// 1. Ambil data peminjaman & alat dulu
$sql_utama = "SELECT * FROM peminjaman 
              JOIN alat ON peminjaman.id_alat = alat.id_alat 
              WHERE peminjaman.id_peminjaman = '$id_pinjam'";
$query_utama = mysqli_query($koneksi, $sql_utama);
$d = mysqli_fetch_array($query_utama);

// 2. Ambil nama user secara terpisah biar gak bikin JOIN error
$id_usernya = $d['id_user'];
$query_user = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$id_usernya'");
$u = mysqli_fetch_array($query_user);

// 3. Simpan nama ke variabel, kalau kosong kasih tanda strip
$nama_peminjam = isset($u['nama_lengkap']) ? $u['nama_lengkap'] : "Pelanggan";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nota Pinjam - <?php echo $d['id_peminjaman']; ?></title>
    <style>
        body { font-family: sans-serif; padding: 30px; }
        .nota-box { border: 2px solid #000; padding: 20px; max-width: 500px; margin: auto; }
        .header { text-align: center; border-bottom: 2px dashed #000; padding-bottom: 10px; margin-bottom: 20px; }
        .row { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .footer { margin-top: 30px; text-align: center; font-size: 12px; }
        @media print { .no-print { display: none; } }
        .logo {
            font-size: 24px;
            font-weight: 900;
            letter-spacing: -1.5px;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="nota-box">
    <div class="header">
        <h1 style="margin:0;" class="logo">EQUIP.</h1>
        <small>Bukti Peminjaman Alat Olahraga</small>
    </div>

    <div class="row"><span>No. Transaksi</span> <strong>#<?php echo $d['id_peminjaman']; ?></strong></div>
    <div class="row"><span>Nama Peminjam</span> <strong><?php echo $nama_peminjam; ?></strong></div>
    <hr>
    <div class="row"><span>Alat</span> <strong><?php echo $d['nama_alat']; ?></strong></div>
    <div class="row"><span>Jumlah</span> <strong><?php echo $d['jumlah']; ?> Unit</strong></div>
    <div class="row"><span>Durasi</span> <strong><?php echo $d['tgl_pinjam']; ?> s/d <?php echo $d['tgl_kembali']; ?></strong></div>
    <hr>
    <div class="row"><span style="font-size: 18px;">TOTAL</span> <strong style="font-size: 18px;">Rp <?php echo number_format($d['total_harga'], 0, ',', '.'); ?></strong></div>

    <div class="footer">
        <p>Status: <strong><?php echo strtoupper($d['status']); ?></strong></p>
        <p>Harap bawa bukti ini saat pengambilan alat.</p>
    </div>
</div>

<div class="no-print" style="text-align:center; margin-top:20px;">
    <button onclick="window.print()" style="padding: 10px 20px; cursor:pointer;">Klik untuk Print</button>
</div>

<script>
    // Langsung buka jendela print pas halaman ke-load
    window.onload = function() { window.print(); }
</script>

</body>
</html>