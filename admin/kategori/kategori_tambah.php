<?php 
session_start();
if($_SESSION['level'] != "admin"){ header("location:../../login.php?pesan=gagal"); exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIP. | Tambah Kategori</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="admin-layout">
    <aside class="admin-sidebar">
        <div class="logo">EQUIP.</div>
        <nav class="side-nav">
            <a href="kategori_tampil.php" class="nav-item active">← KEMBALI</a>
        </nav>
    </aside>

    <main class="admin-content">
        <div class="reveal">
            <h1>TAMBAH KATEGORI</h1>
            <div class="form-card">
                <form action="kategori_proses.php" method="post" class="modern-form">
                    <div class="form-group">
                        <label>NAMA KATEGORI BARU</label>
                        <input type="text" name="nama_kategori" placeholder="Contoh: BOLA BESAR" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-action">SIMPAN DATA</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>