<?php 
session_start();
include '../../koneksi.php';
if($_SESSION['level'] != "admin"){ header("location:../../login.php?pesan=gagal"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIP. | Kategori</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="admin-layout">
    <aside class="admin-sidebar">
        <div class="logo">EQUIP.</div>
        <nav class="side-nav">
            <a href="../dashboard.php" class="nav-item">DASHBOARD</a>
            <a href="../alat/alat_tampil.php" class="nav-item">INVENTORY</a>
            <a href="../user/user_tampil.php" class="nav-item">USER MANAGEMENT</a>
            <a href="kategori_tampil.php" class="nav-item active">KATEGORI</a>
            <a href="../../logout.php" class="nav-item" style="margin-top:50px; color:#ff4444">LOGOUT</a>
        </nav>
    </aside>

    <main class="admin-content">
        <div class="content-header">
            <div>
                <p>MASTER DATA</p>
                <h1>KATEGORI ALAT</h1>
            </div>
            <a href="kategori_tambah.php" class="btn-action">+ TAMBAH KATEGORI</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th width="50">NO</th>
                        <th>NAMA KATEGORI</th>
                        <th width="200">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM kategori");
                    while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><strong><?php echo strtoupper($d['nama_kategori']); ?></strong></td>
                        <td>
                            <a href="kategori_edit.php?id=<?php echo $d['id_kategori']; ?>">EDIT</a>
                            <a href="kategori_hapus.php?id=<?php echo $d['id_kategori']; ?>" class="btn-delete" onclick="return confirm('Hapus kategori ini?')">HAPUS</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>