<?php 
include '../../koneksi.php';
session_start();
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
    <title>EQUIP. | Tambah Alat</title>
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
        <div class="reveal">
            <h1>TAMBAH ALAT</h1>
            
            <form action="alat_proses_tambah.php" method="POST" enctype="multipart/form-data" class="modern-form">
                <div class="form-group">
                    <label>NAMA ALAT</label>
                    <input type="text" name="nama_alat" placeholder="Misal: Dumbbell Pro 10kg" required>
                </div>

                <div class="form-group">
                    <label>KATEGORI</label>
                    <select name="id_kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php 
                        $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while($k = mysqli_fetch_array($kat)){
                            echo "<option value='".$k['id_kategori']."'>".$k['nama_kategori']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>DESKRIPSI</label>
                    <textarea name="deskripsi" rows="4" placeholder="Detail spesifikasi alat..." required></textarea>
                </div>

                <div class="form-grid-two">
                    <div class="form-group">
                        <label>HARGA SEWA / HARI</label>
                        <input type="number" name="harga_per_hari" placeholder="5000" required>
                    </div>
                    <div class="form-group">
                        <label>STOK AWAL</label>
                        <input type="number" name="stok" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Minimal Sewa (Hari)</label>
                    <input type="number" name="min_pinjam" class="form-control" value="<?php echo isset($d['min_pinjam']) ? $d['min_pinjam'] : 1; ?>" min="1" required>
                    <small>*Isi 1 jika tidak ada batasan minimal</small>
                </div>

                <div class="form-group">
                    <label>FOTO ALAT</label>
                    <input type="file" name="foto" accept="image/*" class="file-input" required>
                </div>

                <button type="submit" class="btn-login-new">SIMPAN KE INVENTORY</button>
                <br><br><a href="alat_tampil.php" class="lnk-back">← KEMBALI KE DAFTAR</a>
            </form>
        </div>
    </main>
</body>
</html>