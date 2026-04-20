<?php
session_start();
include '../koneksi.php';

if ($_SESSION['level'] != "petugas") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

// Ambil data statistik dari database
$pending_count = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='pending'"));
$aktif_count   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE status='disetujui'"));
$total_alat    = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM alat"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIP. | Staff Control</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #000; --accent: #acacac; --bg: #f4f4f4; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: var(--bg); display: flex; min-height: 100vh; overflow-x: hidden; }

        /* Sidebar Responsif */
        .sidebar { 
            width: 280px; background: #000; color: #fff; padding: 40px 30px; 
            display: flex; flex-direction: column; transition: 0.3s;
            position: fixed; height: 100vh; z-index: 1000;
        }
        .nav-link { 
            color: #666; text-decoration: none; font-weight: 900; font-size: 12px; 
            letter-spacing: 1px; margin-bottom: 25px; transition: 0.3s;
        }
        .nav-link.active, .nav-link:hover { color: #fff; }
        .btn-logout { margin-top: auto; color: #ff4444; text-decoration: none; font-weight: 900; font-size: 11px; }

        /* Main Content */
        .main-content { flex: 1; margin-left: 280px; padding: 50px; transition: 0.3s; width: calc(100% - 280px); }
        .header { margin-bottom: 50px; }
        .header p { font-weight: 900; font-size: 12px; color: #888; letter-spacing: 2px; }
        .header h1 { font-size: 60px; font-weight: 900; letter-spacing: -3px; line-height: 0.9; margin-top: 10px; }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 50px; }
        .stat-card { background: #fff; padding: 35px; border-left: 8px solid #000; position: relative; overflow: hidden; }
        .stat-card.warning { border-color: var(--accent); background: var(--accent); }
        .stat-card span { font-size: 10px; font-weight: 900; letter-spacing: 1px; color: #888; }
        .stat-card.warning span { color: #000; }
        .stat-card h3 { font-size: 45px; font-weight: 900; margin-top: 10px; }

        /* Recent Activity Table */
        .activity-box { background: #fff; padding: 40px; border: 1px solid #eee; }
        .activity-box h2 { font-weight: 900; letter-spacing: -1px; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; font-size: 10px; font-weight: 900; color: #aaa; text-transform: uppercase; padding-bottom: 15px; border-bottom: 2px solid #f4f4f4; }
        td { padding: 20px 0; border-bottom: 1px solid #f9f9f9; font-size: 13px; }

        /* Hamburger Menu buat HP */
        .menu-toggle { display: none; position: fixed; top: 20px; right: 20px; background: #000; color: #fff; border: none; padding: 10px; z-index: 2001; font-weight: 900; }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .sidebar { left: -280px; }
            .sidebar.active { left: 0; }
            .main-content { margin-left: 0; width: 100%; padding: 30px; }
            .menu-toggle { display: block; }
            .header h1 { font-size: 40px; }
        }
    </style>
</head>
<body>

    <button class="menu-toggle" onclick="toggleSidebar()">MENU</button>

    <aside class="sidebar" id="sidebar">
        <div class="logo" style="font-size: 24px; font-weight: 900; margin-bottom: 60px;">EQUIP. <span style="color:var(--accent)">STAFF</span></div>
        <a href="dashboard.php" class="nav-link active">DASHBOARD</a>
        <a href="peminjaman_tampil.php" class="nav-link">PERMINTAAN PEMINJAMAN</a>
        <a href="laporan.php" class="nav-link">CETAK LAPORAN</a>
        <a href="../logout.php" class="btn-logout">LOGOUT</a>
    </aside>

    <main class="main-content">
        <header class="header">
            <p>SYSTEM STATUS: ONLINE</p>
            <h1>STAFF<br>DASHBOARD.</h1>
            <p style="margin-top: 20px; color: #000;">Halo, <?php echo strtoupper($_SESSION['nama']); ?>. Pantau semua pergerakan gear di sini.</p>
        </header>

        <div class="stats-grid">
            <div class="stat-card warning">
                <span>ACTION REQUIRED</span>
                <h3><?php echo $pending_count; ?></h3>
                <p style="font-size: 11px; font-weight: 700;">Permintaan Pending</p>
            </div>
            <div class="stat-card">
                <span>ACTIVE RENTALS</span>
                <h3><?php echo $aktif_count; ?></h3>
                <p style="font-size: 11px; font-weight: 700;">Barang di User</p>
            </div>
            <div class="stat-card">
                <span>INVENTORY</span>
                <h3><?php echo $total_alat; ?></h3>
                <p style="font-size: 11px; font-weight: 700;">Total Koleksi Alat</p>
            </div>
        </div>

        <section class="activity-box">
            <h2>AKTIFITAS TERBARU</h2>
            <table>
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Item</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Query JOIN sesuai database lo
                    $sql = "SELECT peminjaman.*, users.nama_lengkap, alat.nama_alat 
                            FROM peminjaman 
                            JOIN users ON peminjaman.id_user = users.id_user 
                            JOIN alat ON peminjaman.id_alat = alat.id_alat 
                            ORDER BY id_peminjaman DESC LIMIT 5";
                    $result = mysqli_query($koneksi, $sql);
                    while($r = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><strong><?php echo strtoupper($r['nama_lengkap']); ?></strong></td>
                        <td><?php echo $r['nama_alat']; ?></td>
                        <td>
                            <span style="font-weight:900; font-size:10px; color: <?php echo ($r['status']=='pending') ? '#ffaa00' : '#00aa00'; ?>">
                                // <?php echo strtoupper($r['status']); ?>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>