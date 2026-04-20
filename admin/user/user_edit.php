<?php 
session_start();
include '../../koneksi.php'; 

// Cek level admin
if($_SESSION['level'] != "admin") { 
    header("location:../../login.php"); 
}

// Ambil data user berdasarkan ID
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User - EQUIP. Admin</title>
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
            <a href="user_tampil.php" class="nav-item active">USER MANAGEMENT</a>
            <a href="../../logout.php" class="nav-item" style="margin-top: 50px; color: #ff4444;">LOGOUT</a>
        </nav>
    </div>

    <div class="admin-content">
        <div class="content-header">
            <div>
                <p>ADMINISTRATION / EDIT</p>
                <h1>EDIT USER</h1>
            </div>
        </div>

        <div class="form-card">
            <form action="user_proses_edit.php" method="post" class="modern-form">
                <input type="hidden" name="id_user" value="<?php echo $d['id_user']; ?>">

                <div class="form-group">
                    <label>NAMA LENGKAP</label>
                    <input type="text" name="nama" value="<?php echo $d['nama_lengkap']; ?>" required>
                </div>

                <div class="form-group">
                    <label>USERNAME</label>
                    <input type="text" name="username" value="<?php echo $d['username']; ?>" required>
                </div>

                <div class="form-group">
                    <label>LEVEL USER</label>
                    <select name="level">
                        <option value="admin" <?php if($d['level'] == 'admin') echo 'selected'; ?>>ADMIN</option>
                        <option value="petugas" <?php if($d['level'] == 'petugas') echo 'selected'; ?>>PETUGAS</option>
                        <option value="peminjam" <?php if($d['level'] == 'peminjam') echo 'selected'; ?>>PEMINJAM</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-update">UPDATE USER</button>
                    <a href="user_tampil.php" class="lnk-back">KEMBALI KE DAFTAR</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>