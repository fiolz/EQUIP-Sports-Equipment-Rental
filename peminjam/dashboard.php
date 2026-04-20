<?php 
session_start();
include '../koneksi.php';

// Proteksi Level
if($_SESSION['level'] != "peminjam"){
    header("location:../login.php?pesan=gagal");
    exit();
}

// 1. Definisikan Query Dasar (Pake JOIN biar bisa panggil nama_kategori)
$base_sql = "SELECT alat.*, kategori.nama_kategori 
             FROM alat 
             JOIN kategori ON alat.id_kategori = kategori.id_kategori";

// 2. Logika Filter
if(isset($_GET['kategori']) && !empty($_GET['kategori'])){
    $id_kat = mysqli_real_escape_string($koneksi, $_GET['kategori']);
    $query = mysqli_query($koneksi, "$base_sql WHERE alat.id_kategori='$id_kat'");
} else {
    $query = mysqli_query($koneksi, $base_sql);
}

// 3. Cek apakah query berhasil
if (!$query) {
    die("Query Error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIP. | Explorer</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Navbar & Sidebar */
        .navbar-user { display: flex; justify-content: space-between; align-items: center; padding: 15px 50px; background: white; border-bottom: 1px solid #eee; position: sticky; top: 0; z-index: 1000; }
        .hamburger { cursor: pointer; display: flex; flex-direction: column; gap: 5px; }
        .hamburger span { width: 22px; height: 2px; background: black; }
        
        .side-drawer { position: fixed; top: 0; left: -300px; width: 280px; height: 100vh; background: black; color: white; padding: 50px 30px; z-index: 2000; transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1); }
        .side-drawer.active { left: 0; }
        .drawer-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); display: none; z-index: 1500; }
        .drawer-overlay.active { display: block; }

        .hero-dashboard {
            width: 100%; height: 450px;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1517836357463-d25dfeac3438?q=80&w=1470');
            background-size: cover; background-position: center;
            display: flex; align-items: center; justify-content: center; color: white; text-align: center;
        }

        .hero-content h1 { font-size: 80px; font-weight: 900; line-height: 0.9; letter-spacing: -3px; margin: 10px 0; }
        .hero-tagline { font-weight: 900; letter-spacing: 4px; font-size: 12px; color: #bbb; }
        .hero-desc { font-size: 16px; max-width: 500px; margin: 0 auto; opacity: 0.8; }

        .category-container { padding: 20px 0; background: #fff; border-bottom: 1px solid #eee; position: sticky; top: 70px; z-index: 900; }
        .category-slider { display: flex; gap: 10px; overflow-x: auto; padding: 0 50px; scrollbar-width: none; }
        .category-slider::-webkit-scrollbar { display: none; }
        
        .cat-pill {
            padding: 10px 25px; border: 1px solid #eee; border-radius: 50px;
            white-space: nowrap; font-size: 11px; font-weight: 900;
            text-decoration: none; color: black; transition: 0.3s; text-transform: uppercase;
        }
        .cat-pill:hover, .cat-pill.active { background: black; color: white; border-color: black; }

        /* Grid Produk */
        .content-wrap { padding: 40px 50px; }
        .gear-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .gear-card {
            background: #fff; border: 1px solid #eee;
            display: flex; flex-direction: column; height: 100%; transition: 0.3s;
        }
        .gear-card:hover { border-color: #000; transform: translateY(-5px); }

        .gear-image { width: 100%; height: 250px; background: #f5f5f5; overflow: hidden; }
        .gear-image img { width: 100%; height: 100%; object-fit: cover; }

        .gear-info { padding: 20px; display: flex; flex-direction: column; flex-grow: 1; }
        .gear-cat { font-size: 10px; font-weight: 900; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .gear-name { font-size: 18px; font-weight: 900; margin-bottom: 10px; min-height: 44px; line-height: 1.2; }
        .gear-price { font-weight: 700; font-size: 14px; margin-bottom: 20px; }

        .btn-rent {
            margin-top: auto; width: 100%; background: #000; color: #fff;
            border: none; padding: 15px; font-weight: 900; cursor: pointer;
            text-transform: uppercase; letter-spacing: 1px;
        }
        .btn-rent:hover { background: #333; }

        .footer-dash { padding: 60px 50px; border-top: 1px solid #eee; margin-top: 100px; display: flex; justify-content: space-between; align-items: center; }
        
        #catalog { scroll-margin-top: 68px; }
        .shiny {
            font-size: 4.5rem;
            font-weight: 900;
            line-height: 0.9;
            background: linear-gradient(to right, #ffffff 20%, #a2a2a27d 40%, #52525236 80%);
            background-size: 200% auto;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 3s linear;
        }

        @keyframes shine {
            to { background-position: 200% center; }
        }
    </style>
</head>
<body>

<div class="drawer-overlay" id="overlay" onclick="toggleMenu()"></div>
<aside class="side-drawer" id="sidebar">
    <div class="logo" style="color: white; margin-bottom: 40px;">EQUIP.</div>
    <nav style="display: flex; flex-direction: column; gap: 20px;">
        <a href="dashboard.php" style="color: white; font-weight: 900; text-decoration: none;">DASHBOARD</a>
        <a href="pinjaman_saya.php" style="color: white; font-weight: 900; text-decoration: none;">MY RENTALS</a>
        <a href="../logout.php" style="color: #ff4444; font-weight: 900; text-decoration: none; margin-top: 20px;">LOGOUT</a>
    </nav>
</aside>

<nav class="navbar-user">
    <div class="hamburger" onclick="toggleMenu()"><span></span><span></span><span></span></div>
    <div class="logo">EQUIP.</div>
    <div style="font-weight: 900; font-size: 12px;">HI, <?php echo strtoupper($_SESSION['nama']); ?></div>
</nav>

<header class="hero-dashboard">
    <div class="hero-content">
        <p class="hero-tagline">PREMIUM SPORT RENTALS</p>
        <h1 class="shiny">EQUIP.<br>YOUR GAME.</h1>
        <p class="hero-desc">Sewa perlengkapan olahraga kualitas pro dengan harga jujur.</p>
    </div>
</header>

<div class="category-container" id="catalog">
    <div class="category-slider">
        <a href="dashboard.php#catalog" class="cat-pill <?php echo !isset($_GET['kategori']) ? 'active' : ''; ?>">ALL GEARS</a>
        <?php 
        $cat = mysqli_query($koneksi, "SELECT * FROM kategori");
        while($c = mysqli_fetch_array($cat)) {
            $activeClass = (isset($_GET['kategori']) && $_GET['kategori'] == $c['id_kategori']) ? 'active' : '';
            echo "<a href='?kategori=".$c['id_kategori']."#catalog' class='cat-pill $activeClass'>".strtoupper($c['nama_kategori'])."</a>";
        }
        ?>

    </div>
</div>

<main class="content-wrap">
    <div class="gear-grid">
        <?php while($row = mysqli_fetch_array($query)) { ?>
        <div class="gear-card">
            <div class="gear-image">
                <img src="../assets/img/<?php echo $row['gambar']; ?>" alt="">
            </div>
            <div class="gear-info">
                <p class="gear-cat"><?php echo $row['nama_kategori']; ?></p>
                <h4 class="gear-name"><?php echo strtoupper($row['nama_alat']); ?></h4>
                <p class="gear-price">Rp <?php echo number_format($row['harga_per_hari'], 0, ',', '.'); ?>/hari</p>
                
                <button class="btn-rent" onclick="location.href='pinjam_form.php?id=<?php echo $row['id_alat']; ?>'">
                    RENT NOW
                </button>
            </div>
        </div>
        <?php } ?>
    </div>
</main>

<footer class="footer-dash">
    <div>
        <div class="logo">EQUIP.</div>
        <p style="font-size: 12px; font-weight: 700; color: #888; margin-top: 10px;">&copy; 2026 EQUIP. by Fiola Shakira.</p>
    </div>
    <div style="display: flex; gap: 30px;">
        <div style="text-align: right;">
            <p style="font-size: 10px; font-weight: 900; letter-spacing: 1px; color: #888;">SOCIALS</p>
            <a href="https:/instagram.com/fiouue" target="_blank" style="text-decoration: none; color: black; font-size: 12px; font-weight: 900;">INSTAGRAM</a>
        </div>
        <div style="text-align: right;">
            <p style="font-size: 10px; font-weight: 900; letter-spacing: 1px; color: #888;">CONTACT</p>
            <a href="#" style="text-decoration: none; color: black; font-size: 12px; font-weight: 900;">WHATSAPP</a>
        </div>
    </div>
</footer>

<script>
    function toggleMenu() {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('overlay').classList.toggle('active');
    }
</script>
</body>
</html>