<?php 
session_start();
include '../../koneksi.php'; // Naik 2 tingkat karena berada di sub-folder

// Proteksi halaman admin
if($_SESSION['level'] != "admin") { 
    header("location:../../login.php"); 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah User - EQUIP. Admin</title>
    <link rel="stylesheet" href="../style.css"> </head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<body>

<div class="admin-layout">
    <div class="admin-sidebar">
        <div class="logo">EQUIP.</div>
        <nav class="side-nav">
            <a href="../dashboard.php" class="nav-item">DASHBOARD</a>
            <a href="../alat/alat_tampil.php" class="nav-item">INVENTORY</a>
            <a href="user_tampil.php" class="nav-item active">USER MANAGEMENT</a>
            <a href="../../logout.php" class="nav-item" style="margin-top: 50px; color: #ff4444;">LOGOUT</a>
        </nav>
    </div>

    <div class="admin-content">
        <div class="content-header">
            <div>
                <p>ADMINISTRATION / NEW</p>
                <h1>TAMBAH USER</h1>
            </div>
        </div>

        <div class="form-card">
            <form action="user_proses.php" method="post" class="modern-form">
                
                <div class="form-group">
                    <label>NAMA LENGKAP</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap..." required>
                </div>

                <div class="form-group">
                    <label>USERNAME</label>
                    <input type="text" name="username" placeholder="Masukkan username..." required>
                </div>

                <div class="form-group">
                    <label>PASSWORD</label>
                    <input type="password" name="password" placeholder="Masukkan password baru..." required>
                </div>

                <div class="form-group">
                    <label>LEVEL USER</label>
                    <select name="level" required>
                        <option value="">-- PILIH LEVEL --</option>
                        <option value="admin">ADMIN</option>
                        <option value="petugas">PETUGAS</option>
                        <option value="peminjam">PEMINJAM</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-action">SIMPAN USER</button>
                    <a href="user_tampil.php" class="lnk-back">KEMBALI KE DAFTAR</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>