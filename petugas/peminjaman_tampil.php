<?php 
session_start();
include '../koneksi.php'; // Tetap sesuai file asli

if($_SESSION['level'] != "petugas") { header("location:../login.php"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIP. | Approval List</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f9f9f9; margin: 0; padding: 40px; color: #1a1a1a; }
        .header-section { margin-bottom: 40px; }
        .header-section h2 { font-weight: 900; font-size: 2rem; letter-spacing: -1px; margin: 0; }
        .header-section p { color: #666; font-size: 14px; margin-top: 5px; }

        /* Container Request Cards */
        .request-container { display: grid; gap: 15px; max-width: 900px; }
        
        .request-card { 
            background: white; border: 1px solid #eee; padding: 25px; 
            display: flex; justify-content: space-between; align-items: center;
            transition: 0.3s;
        }
        .request-card:hover { border-color: #000; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }

        .info-group { display: flex; flex-direction: column; gap: 4px; }
        .user-name { font-weight: 900; font-size: 11px; color: #888; letter-spacing: 1px; }
        .gear-name { font-weight: 900; font-size: 18px; font-style: italic; }
        .qty-label { font-size: 13px; color: #555; }
        
        .status-badge { 
            font-size: 10px; font-weight: 900; padding: 4px 12px; 
            background: #fff4e5; color: #ff9800; border-radius: 20px; text-transform: uppercase;
        }

        /* Action Buttons */
        .action-group { display: flex; gap: 10px; }
        .btn { 
            text-decoration: none; font-size: 11px; font-weight: 900; 
            padding: 12px 25px; transition: 0.3s; 
        }
        .btn-approve { background: black; color: white; border: 1px solid black; }
        .btn-approve:hover { background: #333; }
        
        .btn-reject { background: white; color: #ff4444; border: 1px solid #ff4444; }
        .btn-reject:hover { background: #ff4444; color: white; }

        .empty-state { padding: 50px; text-align: center; border: 2px dashed #ddd; color: #888; font-weight: 700; }
    </style>
</head>
<body>

    <div class="header-section">
        <h2>PENDING REQUESTS</h2>
        <p>Kelola permintaan peminjaman alat dari member.</p>
    </div>

    <div class="request-container">
        <?php 
        // Logika SQL SAKLEK sesuai file asli lo
        $sql = "SELECT * FROM peminjaman 
                JOIN users ON peminjaman.id_user = users.id_user 
                JOIN alat ON peminjaman.id_alat = alat.id_alat 
                WHERE status='pending'";
        $query = mysqli_query($koneksi, $sql);

        if(mysqli_num_rows($query) == 0) {
            echo "<div class='empty-state'>TIDAK ADA PERMINTAAN SAAT INI.</div>";
        }

        while($d = mysqli_fetch_array($query)){ ?>
        <div class="request-card">
            <div class="info-group">
                <span class="user-name"><?php echo strtoupper($d['nama_lengkap']); ?></span>
                <span class="gear-name"><?php echo strtoupper($d['nama_alat']); ?></span>
                <span class="qty-label">Jumlah: <b><?php echo $d['jumlah']; ?> Unit</b></span>
                <div style="margin-top: 10px;">
                    <span class="status-badge"><?php echo $d['status']; ?></span>
                </div>
            </div>

            <div class="action-group">
                <a href="peminjaman_aksi.php?id=<?php echo $d['id_peminjaman']; ?>&status=disetujui" class="btn btn-approve">APPROVE</a>
                <a href="peminjaman_aksi.php?id=<?php echo $d['id_peminjaman']; ?>&status=ditolak" class="btn btn-reject">REJECT</a>
            </div>
        </div>
        <?php } ?>
    </div>

</body>
</html>