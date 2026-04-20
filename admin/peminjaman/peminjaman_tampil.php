<?php 
session_start();
include '../../koneksi.php'; // Pakai path lo yang asli

// Proteksi Admin
if($_SESSION['level'] != "admin") { 
    header("location:../../login.php"); 
    exit(); 
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman - EQUIP. Admin</title>
    <link rel="stylesheet" href="../style.css"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="admin-layout">
    <div class="admin-sidebar">
        <div class="logo">EQUIP.</div>
        <nav class="side-nav">
            <a href="../dashboard.php" class="nav-item">DASHBOARD</a>
            <a href="../alat/alat_tampil.php" class="nav-item">INVENTORY</a>
            <a href="../user/user_tampil.php" class="nav-item">USER MANAGEMENT</a>
            <a href="peminjaman_tampil.php" class="nav-item active">TRANSAKSI</a>
            <a href="../../logout.php" class="nav-item" style="margin-top: 50px; color: #ff4444;">LOGOUT</a>
        </nav>
    </div>

    <div class="admin-content">
        <div class="content-header">
            <div>
                <p style="font-weight: 900; letter-spacing: 2px; color: #ccc;">ADMINISTRATION</p>
                <h1>DATA PEMINJAMAN</h1>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // LOGIKA ASLI LO: Join users (plural) dan id_peminjaman DESC
                    $sql = "SELECT * FROM peminjaman 
                            JOIN users ON peminjaman.id_user = users.id_user 
                            JOIN alat ON peminjaman.id_alat = alat.id_alat 
                            ORDER BY id_peminjaman DESC";
                    $query = mysqli_query($koneksi, $sql);
                    
                    while($d = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><strong><?php echo strtoupper($d['nama_lengkap']); ?></strong></td>
                        <td><?php echo $d['nama_alat']; ?></td>
                        <td><?php echo $d['jumlah']; ?> Unit</td>
                        <td><?php echo date('d/m/Y', strtotime($d['tgl_pinjam'])); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($d['tgl_kembali'])); ?></td>
                        <td><strong>Rp <?php echo number_format($d['total_harga'], 0, ',', '.'); ?></strong></td>
                        <td>
                            <?php 
                            if($d['status'] == 'pending') 
                                echo "<span style='color:orange; font-weight:900; font-size:10px;'>PENDING</span>";
                            else if($d['status'] == 'disetujui') 
                                echo "<span style='color:blue; font-weight:900; font-size:10px;'>DIPINJAM</span>";
                            else if($d['status'] == 'kembali') 
                                echo "<span style='color:green; font-weight:900; font-size:10px;'>KEMBALI</span>";
                            else 
                                echo "<span style='color:red; font-weight:900; font-size:10px;'>DITOLAK</span>";
                            ?>
                        </td>
                        <td>
                            <?php if($d['status'] == 'disetujui'){ ?>
                                <a href="peminjaman_kembali.php?id=<?php echo $d['id_peminjaman']; ?>" 
                                   onclick="return confirm('Proses pengembalian barang?')"
                                   style="color: black; border-bottom: 2px solid black; margin-right:10px; text-decoration: none; font-weight: bold; font-size: 11px;">TERIMA</a>
                            <?php } ?>
                            
                            <a href="peminjaman_hapus.php?id=<?php echo $d['id_peminjaman']; ?>" 
                               class="btn-delete"
                               onclick="return confirm('Yakin hapus data ini?')">HAPUS</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>