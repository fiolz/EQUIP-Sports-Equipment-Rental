<?php 
session_start();
include '../koneksi.php';

if($_SESSION['level'] != "peminjam"){
    header("location:../login.php?pesan=gagal");
    exit();
}
$id_user = $_SESSION['id_user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Rentals | EQUIP.</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css"> 

    <style>
        /* RESET & BASE */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: #ffffff; color: #000; line-height: 1.6; }

        /* NAVBAR & DRAWER (Gaya Dashboard) */
        .navbar-user { display: flex; justify-content: space-between; align-items: center; padding: 20px 50px; background: white; border-bottom: 1px solid #eee; position: sticky; top: 0; z-index: 1000; }
        .logo { font-weight: 900; font-size: 20px; letter-spacing: -1px; }

        /* MAIN CONTENT */
        .container-riwayat { max-width: 1200px; margin: 60px auto; padding: 0 50px; }
        .page-header { margin-bottom: 50px; }
        .page-header h1 { font-size: 48px; font-weight: 900; letter-spacing: -2px; line-height: 1; }
        .page-header p { color: #888; font-weight: 700; font-size: 12px; margin-top: 10px; text-transform: uppercase; letter-spacing: 2px; }

        /* TABLE AREA */
        .table-wrapper { width: 100%; overflow-x: auto; border: 2px solid #000; }
        table { width: 100%; border-collapse: collapse; min-width: 800px; }

        th { background: #000; color: #fff; text-align: left; padding: 20px; font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; }
        td { padding: 20px; border-bottom: 1px solid #eee; font-size: 14px; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover { background: #fafafa; }

        /* BADGES (Sebada dengan Dashboard) */
        .badge { display: inline-block; padding: 6px 12px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; }
        .badge.pending { background: #000; color: #fff; }
        .badge.disetujui { background: #e0f2fe; color: #0369a1; }
        .badge.kembali { background: #dcfce7; color: #166534; }
        .badge.ditolak { background: #fee2e2; color: #991b1b; }

        /* ACTION BUTTON */
        .btn-nota { display: inline-block; border: 1.5px solid #000; padding: 8px 16px; color: #000; text-decoration: none; font-size: 11px; font-weight: 900; transition: 0.2s ease; text-transform: uppercase; }
        .btn-nota:hover { background: #000; color: #fff; }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar-user { padding: 15px 20px; }
            .container-riwayat { padding: 0 20px; margin: 40px auto; }
            .page-header h1 { font-size: 32px; }
        }
    </style>
</head>
<body>

    <nav class="navbar-user">
        <div class="logo">EQUIP.</div>
        <div style="font-weight: 900; font-size: 12px; letter-spacing: 1px;">
            <a href="dashboard.php" style="text-decoration:none; color:black; margin-right:20px;">BACK</a>
            HI, <?php echo strtoupper($_SESSION['nama']); ?>
        </div>
    </nav>

    <main class="container-riwayat">
        <div class="page-header">
            <p>Rental History</p>
            <h1>MY GEAR<br>COLLECTION.</h1>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Alat</th>
                        <th>Durasi</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $data = mysqli_query($koneksi, "SELECT * FROM peminjaman 
                            JOIN alat ON peminjaman.id_alat = alat.id_alat 
                            WHERE peminjaman.id_user = '$id_user' 
                            ORDER BY id_peminjaman DESC");

                    // HITUNG JUMLAH DATA
                    if(mysqli_num_rows($data) > 0) {
                        while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td style="font-weight: 900; letter-spacing: -0.5px;">
                                <?php echo strtoupper($d['nama_alat']); ?>
                            </td>
                            <td style="color: #666; font-size: 12px; font-weight: 700;">
                                <?php echo date('d.m.y', strtotime($d['tgl_pinjam'])); ?> — 
                                <?php echo date('d.m.y', strtotime($d['tgl_kembali'])); ?>
                            </td>
                            <td style="font-weight: 700;"><?php echo $d['jumlah']; ?></td>
                            <td style="font-weight: 900;">
                                Rp <?php echo number_format($d['total_harga'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <span class="badge <?php echo $d['status']; ?>">
                                    <?php 
                                        if($d['status'] == 'pending') echo "Pending";
                                        else if($d['status'] == 'disetujui') echo "Disetujui";
                                        else if($d['status'] == 'kembali') echo "Dikembalikan";
                                        else echo "Ditolak";
                                    ?>
                                </span>
                            </td>
                            <td>
                                <a href="cetak_bukti.php?id=<?php echo $d['id_peminjaman']; ?>" target="_blank" class="btn-nota">
                                    Cetak Nota
                                </a>
                            </td>
                        </tr>
                        <?php 
                        } 
                    } else { 
                        // TAMPILKAN PESAN INI JIKA DATA KOSONG
                        ?>
                        <tr>
                            <td colspan="6" style="padding: 100px 20px; text-align: center; background: #fff;">
                                <h3 style="font-weight: 900; letter-spacing: -1px; color: #000; margin-bottom: 10px;">BELUM ADA GEAR YANG DIPINJAM.</h3>
                                <p style="font-size: 12px; color: #888; text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">Koleksi lo masih kosong, ayo sewa gear sekarang!</p>
                                <a href="dashboard.php" style="display: inline-block; margin-top: 25px; padding: 12px 25px; background: #000; color: #fff; text-decoration: none; font-weight: 900; font-size: 11px;">EKSPLOR ALAT</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>