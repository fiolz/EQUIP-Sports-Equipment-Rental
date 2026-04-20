<?php 
session_start();
include '../../koneksi.php';
if($_SESSION['level'] != "admin"){
    header("location:../../login.php?pesan=gagal");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIP. | Data Alat</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="admin-layout">
    <aside class="admin-sidebar">
        <div class="logo">EQUIP.</div>
        <nav class="side-nav">
            <a href="../dashboard.php" class="nav-item">DASHBOARD</a>
            <a href="alat_tampil.php" class="nav-item active">KELOLA ALAT</a>
            <a href="../../logout.php" class="nav-item" style="color:#ff4444">LOGOUT</a>
        </nav>
    </aside>

    <main class="admin-content">
        <header class="content-header">
            <div class="header-title">
                <h1>INVENTORY</h1>
                <p>Manajemen stok dan daftar peralatan olahraga.</p>
            </div>
            <a href="alat_tambah.php" class="btn-action">+ TAMBAH ALAT</a>
        </header>

        <div class="table-container">
            <table>
            <tr>
                <th>NO</th>
                <th>NAMA ALAT</th>
                <th>KATEGORI</th> <th>HARGA (Rp)</th> <th>STOK</th>
                <th>AKSI</th>
            </tr>
            <?php 
            $no = 1;
            // Kuncinya ada di JOIN ini ege, biar PHP tau ID 1 itu namanya apa
            $query = mysqli_query($koneksi, "SELECT alat.*, kategori.nama_kategori 
                                            FROM alat 
                                            JOIN kategori ON alat.id_kategori = kategori.id_kategori");

            while($d = mysqli_fetch_array($query)){
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['nama_alat']; ?></td>
                    
                    <td><?php echo $d['nama_kategori']; ?></td> 
                    
                    <td><?php echo number_format($d['harga_per_hari'], 0, ',', '.'); ?></td>
                    <td><?php echo $d['stok']; ?> unit</td>
                    <td>
                        <a href="alat_edit.php?id=<?php echo $d['id_alat']; ?>">EDIT</a> | 
                        <a href="alat_hapus.php?id=<?php echo $d['id_alat']; ?>">HAPUS</a>
                    </td>
                </tr>
            <?php 
            }
            ?>
        </table>
        </div>
    </main>
</body>
</html>