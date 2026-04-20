<?php 
session_start();
include '../koneksi.php';

// Cek Level Petugas
if($_SESSION['level'] != "petugas"){
    header("location:../login.php?pesan=gagal");
    exit();
}

// Ambil filter tanggal kalau ada
$tgl_awal  = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : '';
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIP. | Official Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { padding: 40px; background: #fff; color: #000; }
        
        /* Header Laporan ala Dokumen Kantor */
        .report-header { border-bottom: 5px solid #000; padding-bottom: 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: flex-end; }
        .report-header h1 { font-size: 50px; font-weight: 900; letter-spacing: -3px; line-height: 0.8; }
        
        /* Filter Box (Hilang saat diprint) */
        .filter-section { background: #f4f4f4; padding: 20px; margin-bottom: 30px; border-radius: 4px; }
        .filter-section form { display: flex; gap: 15px; align-items: center; }
        .filter-section input { padding: 8px; border: 1px solid #ccc; }
        .btn-filter { background: #000; color: #fff; border: none; padding: 10px 20px; font-weight: 900; cursor: pointer; font-size: 11px; }
        .btn-print { background: #000; color: #fff; text-decoration: none; padding: 10px 20px; font-weight: 900; font-size: 11px; display: inline-block; cursor: pointer; border:none; }

        /* Tabel Laporan */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #000; color: #fff; padding: 12px; text-align: left; font-size: 11px; font-weight: 900; text-transform: uppercase; border: 1px solid #000; }
        td { padding: 12px; border: 1px solid #ddd; font-size: 13px; }
        .total-row { font-weight: 900; background: #f9f9f9; }

        @media print {
            .filter-section, .btn-back { display: none; }
            body { padding: 0; }
            .report-header { margin-top: 0; }
        }
        /* --- PERBAIKAN RESPONSIVE --- */

        /* 1. Navbar & Hero biar gak kepotong */
        .navbar-user { 
            padding: 15px 5%; /* Pake persen biar dinamis */
        }

        .hero-dashboard {
            height: auto; 
            min-height: 300px;
            padding: 40px 20px;
        }

        /* 2. Grid Alat: Kuncinya di sini! */
        .gear-grid {
            display: grid;
            /* Auto-fill bakal bikin kolom nyesuain sendiri tanpa bikin error */
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); 
            gap: 20px;
        }

        /* 3. Footer biar gak tumpang tindih */
        .footer-dash {
            flex-wrap: wrap; /* Biar elemen pindah ke bawah kalo gak muat */
            gap: 30px;
            padding: 40px 5%;
        }

        /* 4. Media Query khusus HP */
        @media (max-width: 600px) {
            .hero-content h1 { font-size: 45px; } /* Tulisan gede dikecilin di HP */
            .content-wrap { padding: 20px; }
            .category-slider { padding: 0 20px; }
            
            .footer-dash { 
                flex-direction: column; 
                text-align: center; 
            }
            .footer-dash div { text-align: center !important; }
        }
    </style>
</head>
<body>

    <div style="margin-bottom: 20px;" class="btn-back">
        <a href="dashboard.php" style="text-decoration:none; color:#888; font-weight:900; font-size:12px;">← KEMBALI KE DASHBOARD</a>
    </div>

    <div class="report-header">
        <div>
            <p style="font-weight:900; font-size:12px; color:#888; margin-bottom:10px;">MONTHLY TRANSACTION REPORT</p>
            <h1>EQUIP.<br>SYSTEMS.</h1>
        </div>
        <button onclick="window.print()" class="btn-print">PRINT PDF</button>
    </div>

    <div class="filter-section">
        <form method="GET">
            <label style="font-size:11px; font-weight:900;">DARI:</label>
            <input type="date" name="tgl_awal" value="<?php echo $tgl_awal; ?>" required>
            <label style="font-size:11px; font-weight:900;">SAMPAI:</label>
            <input type="date" name="tgl_akhir" value="<?php echo $tgl_akhir; ?>" required>
            <button type="submit" class="btn-filter">FILTER DATA</button>
            <a href="laporan.php" style="font-size:11px; color:#666; font-weight:900; text-decoration:none;">RESET</a>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Peminjam</th>
                <th>Nama Alat</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $total_pendapatan = 0;
            $where = "";

            // Logika Filter Tanggal
            if($tgl_awal != "" && $tgl_akhir != ""){
                $where = "WHERE tgl_pinjam BETWEEN '$tgl_awal' AND '$tgl_akhir'";
            }

            // Query JOIN sesuai struktur DB lo
            $sql = "SELECT peminjaman.*, users.nama_lengkap, alat.nama_alat 
                    FROM peminjaman 
                    JOIN users ON peminjaman.id_user = users.id_user 
                    JOIN alat ON peminjaman.id_alat = alat.id_alat 
                    $where ORDER BY id_peminjaman DESC";
            
            $query = mysqli_query($koneksi, $sql);
            
            if(mysqli_num_rows($query) > 0) {
                while($d = mysqli_fetch_array($query)){
                    $total_pendapatan += $d['total_harga'];
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo date('d/m/Y', strtotime($d['tgl_pinjam'])); ?></td>
                <td style="font-weight:700;"><?php echo strtoupper($d['nama_lengkap']); ?></td>
                <td><?php echo strtoupper($d['nama_alat']); ?></td>
                <td><?php echo $d['jumlah']; ?></td>
                <td>Rp <?php echo number_format($d['total_harga'], 0, ',', '.'); ?></td>
                <td style="font-weight:900; font-size:10px;"><?php echo strtoupper($d['status']); ?></td>
            </tr>
            <?php 
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center; padding:30px;'>Tidak ada data transaksi pada periode ini.</td></tr>";
            }
            ?>
            <tr class="total-row">
                <td colspan="5" style="text-align:right;">TOTAL PENDAPATAN</td>
                <td colspan="2">Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right;">
        <p>Klaten, <?php echo date('d F Y'); ?></p>
        <p style="margin-top:80px; font-weight:900;">( <?php echo $_SESSION['nama']; ?> )</p>
        <p style="font-size:11px; color:#888;">OFFICIAL STAFF EQUIP.</p>
    </div>

</body>
</html>