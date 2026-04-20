<?php 
session_start();
include '../../koneksi.php';

if($_SESSION['level'] != "admin"){
    header("location:../../login.php");
    exit();
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM alat WHERE id_alat='$id'");
$d = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EQUIP. | Edit Alat</title>
    <link rel="stylesheet" href="../style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h1>EDIT ALAT</h1>
        <div class="form-card">
            <form action="alat_proses_edit.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_alat" value="<?php echo $d['id_alat']; ?>">

                <div class="form-group">
                    <label>NAMA ALAT</label>
                    <input type="text" name="nama_alat" value="<?php echo $d['nama_alat']; ?>" required>
                </div>

                <div class="form-group">
                    <label>KATEGORI</label>
                    <select name="id_kategori" required>
                        <?php 
                        $kat = mysqli_query($koneksi, "SELECT * FROM kategori");
                        while($k = mysqli_fetch_array($kat)){
                            // Logika agar kategori yang lama otomatis terpilih
                            $select = ($k['id_kategori'] == $d['id_kategori']) ? 'selected' : '';
                            echo "<option value='".$k['id_kategori']."' $select>".$k['nama_kategori']."</option>";
                        }
                        ?>
                    </select>
                </div>

               <div class="form-group">
                    <label>DESKRIPSI</label>
                    <textarea name="deskripsi" rows="4" required><?php echo $d['deskripsi']; ?></textarea>
                </div>

                <div class="form-group">
                    <label>HARGA PER HARI</label>
                    <input type="number" name="harga_per_hari" value="<?php echo $d['harga_per_hari']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Minimal Sewa (Hari)</label>
                    <input type="number" name="min_pinjam" class="form-control" value="<?php echo isset($d['min_pinjam']) ? $d['min_pinjam'] : 1; ?>" min="1" required>
                    <small>*Isi 1 jika tidak ada batasan minimal</small>
                </div>

                <div class="form-group">
                    <label>STOK</label>
                    <input type="number" name="stok" value="<?php echo $d['stok']; ?>" required>
                </div>

                <div class="form-group">
                    <label>FOTO SAAT INI</label><br>
                    <img src="../../assets/img/<?php echo $d['gambar']; ?>" width="100" style="margin-bottom: 10px; border: 1px solid #ddd;">
                    <br>
                    <label>GANTI FOTO (Kosongkan jika tidak ingin ganti)</label>
                    <input type="file" name="foto" accept="image/*">
                </div>

                <button type="submit" name="update" class="btn-update">SAVE CHANGES</button>
                <br><br>
                <a href="alat_tampil.php" class="lnk-back">KEMBALI</a>
    
            </form>
        </div>
    </main>