<?php 
session_start();
include '../../koneksi.php';

if($_SESSION['level'] != "admin"){
    header("location:../../login.php?pesan=gagal");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data User - EQUIP. Admin</title>
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
                <p>ADMINISTRATION</p>
                <h1>MANAJEMEN USER</h1>
            </div>
            <a href="user_tambah.php" class="btn-action">+ TAMBAH USER</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM users");
                    while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><strong><?php echo strtoupper($d['nama_lengkap']); ?></strong></td>
                            <td><?php echo $d['username']; ?></td>
                            <td>
                                <span style="font-size: 10px; font-weight: 900; background: #eee; padding: 4px 8px;">
                                    <?php echo strtoupper($d['level']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="user_edit.php?id=<?php echo $d['id_user']; ?>">EDIT</a>
                                <a href="user_hapus.php?id=<?php echo $d['id_user']; ?>" class="btn-delete" onclick="return confirm('Hapus user ini?')">HAPUS</a>
                            </td>
                        </tr>
                        <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>