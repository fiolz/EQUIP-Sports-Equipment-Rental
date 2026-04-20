<?php
session_start();
include '../koneksi.php';

// Cek apakah yang mengakses halaman ini sudah login dan apakah dia admin
if ($_SESSION['level'] != "admin") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

// Data statistik real-time dari database lo
$total_user    = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users WHERE level='peminjam'"));
$alat_keluar   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='disetujui'"));
$stok_kritis   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM alat WHERE stok < 5"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIP. | Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: #fff; display: flex; min-height: 100vh; color: #000; }

        /* Sidebar Warna Hitam */
        .sidebar { 
            width: 260px; background: #000; color: #fff; 
            padding: 40px 25px; position: fixed; height: 100vh; transition: 0.3s;
            display: flex; flex-direction: column;
        }
        .logo { font-size: 24px; font-weight: 900; letter-spacing: -1.5px; margin-bottom: 50px; color: #fff; }
        .nav-link { 
            display: block; color: #666; text-decoration: none; font-weight: 900; 
            font-size: 11px; letter-spacing: 1px; margin-bottom: 25px; transition: 0.3s;
        }
        .nav-link:hover, .nav-link.active { color: #fff; }
        .logout-link { margin-top: auto; color: #ff4444; text-decoration: none; font-weight: 900; font-size: 11px; }

        /* Area Utama Putih */
        .main { flex: 1; margin-left: 260px; padding: 50px; width: calc(100% - 260px); }
        .header { margin-bottom: 50px; border-left: 5px solid #000; padding-left: 20px; }
        .header h1 { font-size: 50px; font-weight: 900; letter-spacing: -2px; line-height: 1; }
        .header p { color: #888; font-size: 12px; margin-top: 10px; font-weight: 700; letter-spacing: 1px; }

        /* Kartu Statistik */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 50px; }
        .stat-card { padding: 30px; border: 1px solid #eee; background: #fff; position: relative; }
        .stat-card span { font-size: 10px; font-weight: 900; color: #bbb; letter-spacing: 1px; }
        .stat-card h2 { font-size: 45px; font-weight: 900; margin: 5px 0; letter-spacing: -1px; }
        .stat-card.danger { border-top: 4px solid #ff4444; }
        .stat-card.danger h2 { color: #ff4444; }

        /* Grid Menu Kotak Hitam */
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; }
        .menu-box { 
            background: #000; color: #fff; padding: 30px; text-decoration: none; 
            transition: 0.3s; display: flex; flex-direction: column; justify-content: space-between;
        }
        .menu-box:hover { background: #333; transform: translateY(-5px); }
        .menu-box h4 { font-weight: 900; font-size: 13px; letter-spacing: 1px; }
        .menu-box p { font-size: 11px; opacity: 0.6; margin-top: 10px; font-weight: 400; }

        /* Tombol Mobile */
        .btn-mobile { display: none; position: fixed; top: 20px; right: 20px; background: #000; color: #fff; border: none; padding: 10px 20px; font-weight: 900; z-index: 1000; font-size: 10px; }

        @media (max-width: 900px) {
            .sidebar { left: -260px; }
            .sidebar.active { left: 0; }
            .main { margin-left: 0; width: 100%; padding: 40px 20px; }
            .btn-mobile { display: block; }
            .header h1 { font-size: 35px; }
        }
    </style>
</head>
<body>

    <button class="btn-mobile" onclick="toggleMenu()">MENU SYSTEM</button>

    <aside class="sidebar" id="sidebar">
        <div class="logo">EQUIP.</div>
        <nav>
            <a href="dashboard.php" class="nav-link active">DASHBOARD</a>
            <a href="user/user_tampil.php" class="nav-link">KELOLA USER</a>
            <a href="kategori/kategori_tampil.php" class="nav-link">KELOLA KATEGORI</a>
            <a href="alat/alat_tampil.php" class="nav-link">KELOLA ALAT</a>
            <a href="peminjaman/peminjaman_tampil.php" class="nav-link">KELOLA PINJAMAN</a>
        </nav>
        <a href="../logout.php" class="logout-link">LOGOUT</a>
    </aside>

    <main class="main">
        <header class="header">
            <p>ADMIN PANEL // <?php echo strtoupper($_SESSION['nama']); ?></p>
            <h1>ADMIN<br>DASHBOARD</h1>
        </header>

        <div class="stats-grid">
            <div class="stat-card">
                <span>TOTAL PEMINJAM</span>
                <h2><?php echo $total_user; ?></h2>
                <p style="font-size: 10px; color: #888; font-weight: 700;">USER TERDAFTAR</p>
            </div>
            <div class="stat-card">
                <span>ALAT DIPAKAI</span>
                <h2><?php echo $alat_keluar; ?></h2>
                <p style="font-size: 10px; color: #888; font-weight: 700;">BARANG DI LUAR</p>
            </div>
            <div class="stat-card <?php echo ($stok_kritis > 0) ? 'danger' : ''; ?>">
                <span>STOK TIPIS</span>
                <h2><?php echo $stok_kritis; ?></h2>
                <p style="font-size: 10px; color: #888; font-weight: 700;">
                    <?php echo ($stok_kritis > 0) ? 'SEGERA CEK INVENTARIS!' : 'STOK AMAN'; ?>
                </p>
            </div>
        </div>

        <div class="menu-grid">
            <a href="user/user_tampil.php" class="menu-box">
                <h4>USER</h4>
                <p>Kelola data member dan hak akses sistem.</p>
            </a>
            <a href="kategori/kategori_tampil.php" class="menu-box">
                <h4>KATEGORI</h4>
                <p>Atur jenis klasifikasi alat olahraga.</p>
            </a>
            <a href="alat/alat_tampil.php" class="menu-box">
                <h4>ALAT</h4>
                <p>Update stok dan kondisi peralatan.</p>
            </a>
            <a href="peminjaman/peminjaman_tampil.php" class="menu-box">
                <h4>PINJAMAN</h4>
                <p>Pantau semua transaksi peminjaman.</p>
            </a>
        </div>
    </main>

    <script>
        function toggleMenu() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>