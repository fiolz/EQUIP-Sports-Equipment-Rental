<?php 
session_start();
include '../koneksi.php';

if($_SESSION['level'] != "peminjam"){
    header("location:../login.php?pesan=gagal");
    exit();
}

$id = $_GET['id']; 
$data = mysqli_query($koneksi, "SELECT * FROM alat WHERE id_alat='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Pinjam <?php echo $d['nama_alat']; ?> - EQUIP.</title>
    <link rel="stylesheet" href="../style.css"> 
    <style>
        /* BASE LAYOUT */
        .container-pinjam { 
            display: flex; 
            gap: 50px; 
            max-width: 1100px; 
            margin: 60px auto; 
            padding: 40px;
            background: #fff;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            border-radius: 12px;
        }

        .produk-visual { flex: 1.2; min-width: 0; }
        .produk-visual img { 
            width: 100%; 
            border-radius: 8px; 
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .form-section { flex: 1; min-width: 0; }
        
        /* DATE INPUT FLEX */
        .date-row { display: flex; gap: 15px; margin-bottom: 20px; }
        .date-col { flex: 1; }

        /* RESPONSIVE BREAKPOINT (HP/TABLET) */
        @media screen and (max-width: 768px) {
            .container-pinjam {
                flex-direction: column; /* Tumpuk ke bawah */
                margin: 20px;
                padding: 20px;
                gap: 30px;
            }

            .form-section {
                border-top: 1px solid #eee;
                padding-top: 30px;
            }

            .date-row {
                flex-direction: column; /* Input tanggal tumpuk ke bawah di HP */
            }

            h1 { font-size: 2rem !important; }
        }

        /* STYLING TAMBAHAN */
        .badge-stok { display: inline-block; padding: 5px 12px; background: #f0f0f0; font-size: 11px; font-weight: 900; margin-bottom: 10px; }
        .total-box { margin-top: 25px; padding: 20px; background: #000; color: #fff; border-radius: 4px; }
        .desc-box { margin: 20px 0; font-size: 14px; color: #555; line-height: 1.6; border-top: 1px solid #eee; padding-top: 15px; }
    </style>
</head>
<body>

<div class="container-pinjam">
    <div class="produk-visual">
        <img src="../assets/img/<?php echo $d['gambar']; ?>" alt="<?php echo $d['nama_alat']; ?>">
        
        <div class="desc-box">
            <h3 style="color:#000; margin-bottom:10px;">DESKRIPSI PRODUK</h3>
            <p><?php echo $d['deskripsi']; ?></p>
        </div>
    </div>

    <div class="form-section">
        <div class="badge-stok">STOK TERSEDIA: <?php echo $d['stok']; ?> UNIT</div>
        <h1 style="font-weight: 900; letter-spacing: -2px; font-size: 2.5rem; margin: 0;"><?php echo strtoupper($d['nama_alat']); ?></h1>
        <p style="color: #888; margin-top: 5px;">Rp <?php echo number_format($d['harga_per_hari'], 0, ',', '.'); ?> / hari</p>

        <form action="pinjam_proses.php" method="POST" style="margin-top: 30px;">
            <input type="hidden" name="id_alat" value="<?php echo $id; ?>">
            <input type="hidden" id="harga_satuan" value="<?php echo $d['harga_per_hari']; ?>">

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display:block; font-weight:900; font-size:11px; margin-bottom:8px; letter-spacing: 1px;">JUMLAH UNIT</label>
                <input type="number" name="jumlah" id="jumlah" min="1" max="<?php echo $d['stok']; ?>" 
                       oninput="hitungTotal()" style="width:100%; padding:14px; background:#f9f9f9; border:1px solid #eee; box-sizing: border-box;" required>
            </div>

            <div class="date-row">
                <div class="date-col">
                    <label style="display:block; font-weight:900; font-size:11px; margin-bottom:8px; letter-spacing: 1px;">TGL PINJAM</label> 
                    <input type="date" name="tgl_pinjam" id="tgl_pinjam" min="<?php echo date('Y-m-d'); ?>"
                           onchange="hitungTotal()" style="width:100%; padding:14px; background:#f9f9f9; border:1px solid #eee; box-sizing: border-box;" required>
                </div>
                <div class="date-col">
                    <label style="display:block; font-weight:900; font-size:11px; margin-bottom:8px; letter-spacing: 1px;">TGL KEMBALI</label>
                    <input type="date" name="tgl_kembali" id="tgl_kembali" 
                           onchange="hitungTotal()" style="width:100%; padding:14px; background:#f9f9f9; border:1px solid #eee; box-sizing: border-box;" required>
                </div>
            </div>

            <?php if ($d['min_pinjam'] > 1) { ?>
            <div style="background: #fff3cd; color: #856404; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #ffeeba;">
                <strong>⚠️ Perhatian:</strong> 
                Alat ini minimal dipinjam <strong><?php echo $d['min_pinjam']; ?> Hari</strong>.
            </div>
            <?php } ?>

            <div class="total-box">
                <p style="font-size: 10px; opacity: 0.6; margin-bottom: 5px; letter-spacing: 1px;">ESTIMASI TOTAL BIAYA</p>
                <h2 id="display_total" style="font-weight: 900; margin: 0;">Rp 0</h2>
            </div>

            <button type="submit" style="width: 100%; margin-top: 20px; padding: 20px; background: #000; color: #fff; border: none; font-weight: 900; cursor: pointer; letter-spacing: 1px; font-size: 14px;">
                KONFIRMASI PINJAM
            </button>
            
            <a href="dashboard.php" style="display:block; text-align:center; margin-top:20px; font-size:12px; color:#aaa; text-decoration:none; font-weight: 700;">← BATAL</a>
        </form>
    </div>
</div>

<script>
function hitungTotal() {
    var hargaSatuan = document.getElementById('harga_satuan').value;
    var jumlah = document.getElementById('jumlah').value;
    var tglPinjam = new Date(document.getElementById('tgl_pinjam').value);
    var tglKembali = new Date(document.getElementById('tgl_kembali').value);
    
    if (tglPinjam && tglKembali && tglKembali >= tglPinjam && jumlah > 0) {
        var diffTime = Math.abs(tglKembali - tglPinjam);
        var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
        if(diffDays == 0) diffDays = 1;

        if(diffDays > 30) {
            alert("Maksimal peminjaman adalah 30 hari!");
            document.getElementById('tgl_kembali').value = "";
            document.getElementById('display_total').innerHTML = "Rp 0";
            return;
        }

        var total = hargaSatuan * jumlah * diffDays;
        document.getElementById('display_total').innerHTML = "Rp " + total.toLocaleString('id-ID');
    } else {
        document.getElementById('display_total').innerHTML = "Rp 0";
    }
}
</script>

</body>
</html>