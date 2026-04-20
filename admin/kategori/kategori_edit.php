<?php 
include '../../koneksi.php';
session_start();
if($_SESSION['level'] != "admin"){ header("location:../../login.php?pesan=gagal"); exit(); }

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori='$id'");
$d = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIP. | Edit Kategori</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="admin-layout">
    <aside class="admin-sidebar">
        <div class="logo">EQUIP.</div>
        <nav class="side-nav">
            <a href="kategori_tampil.php" class="nav-item active">← BATAL</a>
        </nav>
    </aside>

    <main class="admin-content">
        <h1>EDIT KATEGORI</h1>
        <div class="form-card">
            <form action="kategori_proses_edit.php" method="post" class="modern-form">
                <input type="hidden" name="id_kategori" value="<?php echo $d['id_kategori']; ?>">
                <div class="form-group">
                    <label>NAMA KATEGORI</label>
                    <input type="text" name="nama_kategori" value="<?php echo $d['nama_kategori']; ?>" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-update">UPDATE KATEGORI</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>