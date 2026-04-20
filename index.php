<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIP. | Premium Sport Rentals</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <style>
       /* Container Slider di Sisi Kanan */
        .hero-image-container {
            width: 90%;
            height: 90%;
            background: #eee;
        }

        .hero-slide {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 90%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            filter: grayscale(100%) brightness(0.8);
            border-radius: 30px;
        }

        .hero-slide.active {
            opacity: 1;
        }

        /* Responsif buat HP */
        @media (max-width: 992px) {
            .hero {
                flex-direction: column !important;
                padding: 40px 20px !important;
                height: auto !important;
                text-align: center !important;
            }
            .hero-text { text-align: center !important; }
            .hero-image-container { height: 300px; order: -1; } /* Gambar pindah ke atas teks di HP */
            .shiny-text { font-size: 3rem; }
        }
    </style>

</head>
<body>

    <nav class="navbar">
        <div class="logo">
            EQUIP. <span class="by-author">by Ola</span>
        </div>
        <ul class="nav-links">
            <li><a href="#about-yapping">TENTANG KAMI</a></li>
            <li><a href="#categories">KATEGORI</a></li>
            <li><a href="#footer">HUBUNGI</a></li>
        </ul>
        <a href="login.php" class="btn-login">LOGIN</a>
    </nav>

    <header class="hero" style="display: flex; align-items: center; justify-content: space-between; padding: 0 80px; height: 85vh; gap: 40px;">
    <div class="hero-text" style="flex: 1; text-align: left;">
        <h1 class="shiny-text">LEVEL UP<br>YOUR GAME.</h1>
        <p style="margin: 20px 0; color: #555; line-height: 1.6;">
            Pinjam peralatan olahraga standar profesional tanpa ribet. Fokus pada performa, biarkan kami urus ketersediaan alatnya.
        </p>
        <button class="btn-main" onclick="window.location.href='login.php'">MULAI PINJAM SEKARANG</button>
    </div>

    <div class="hero-image-container" style="flex: 1; position: relative; height: 500px; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
    <div class="hero-slide active" style="background-image: url('assets/img/pic1.jpg');"></div>
    <div class="hero-slide" style="background-image: url('assets/img/pic2.jpg');"></div>
    <div class="hero-slide" style="background-image: url('assets/img/pic3.jpg');"></div>
    <div class="hero-slide" style="background-image: url('assets/img/pic4.jpg');"></div>
    <div class="hero-slide" style="background-image: url('assets/img/pic5.jpg');"></div>
    <div class="hero-slide" style="background-image: url('assets/img/pic6.jpg');"></div>
    </div>

    </header>

    <section id="about-yapping">
        <div class="about-container">
            <div class="about-label italic">WHO WE ARE</div>
            <div class="about-content">
                <h2>GA PERLU KE GYM<br>BUAT OLAHRAGA.</h2>
                <p>
                    Di <strong>EQUIP.</strong>, kami percaya bahwa keterbatasan alat bukan alasan untuk berhenti bergerak. Kami menyediakan akses ke peralatan olahraga kelas dunia—mulai dari raket profesional hingga perlengkapan gym berat—yang bisa lo sewa dengan hitungan jam atau hari. Ngegym dirumah? BISA AJA! 
                    <br><br>
                    Gak perlu beli mahal, gak perlu pusing perawatan. Lo cuma perlu fokus ke latihan, biar kami yang urus sisanya.
                    <br><br>
                    Mau main billiard bareng keluarga di rumah? BISA AJA!
                    <br>
                    Yuk sewa alat olahraga apapun di EQUIP!
                </p>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="feature-item">
            <div class="num">01</div>
            <h3>Kualitas Pro</h3>
            <p>Alat dicek berkala untuk performa maksimal.</p>
        </div>
        <div class="feature-item">
            <div class="num">02</div>
            <h3>Harga Transparan</h3>
            <p>Biaya sewa harian tanpa biaya tersembunyi.</p>
        </div>
        <div class="feature-item">
            <div class="num">03</div>
            <h3>Pick-up Cepat</h3>
            <p>Booking lewat web, ambil dalam 5 menit.</p>
        </div>
    </section>

    <section id="categories">
        <div class="cat-header">
            <h2>PILIH CABANGMU.</h2>
        </div>
        <div class="cat-grid">
            <div class="cat-card">
                <img src="assets/img/gym.jpg" alt="Gym">
                <div class="cat-overlay">
                    <h3>GYM & FITNESS</h3>
                    <p>Dumbbell, Barbel, Bench</p>
                </div>
            </div>
            <div class="cat-card">
                <img src="assets/img/basket.jpg" alt="Bola">
                <div class="cat-overlay">
                    <h3>FIELD SPORT</h3>
                    <p>Basket, Tenis, Golf</p>
                </div>
            </div>
            <div class="cat-card">
                <img src="assets/img/yoga.jpg" alt="Yoga">
                <div class="cat-overlay">
                    <h3>RECOVERY YOGA</h3>
                    <p>Matras, Yoga Set, Pilates</p>
                </div>
            </div>
            
            <a href="login.php">
            <div class="cat-card dark-card">
                <h3 style="font-weight: 900; font-style: italic; text-decoration: none;">LAINNYA</h3>
                <span>→</span>
            </div>
            </a>

        </div>
    </section>

    <footer class="footer" id="footer">
        <div class="logo">EQUIP.</div>
        <p>&copy; 2026 EQUIP. by Fiola Shakira.</p> 
        <p>All right reserved.</p>
        <p>RENTAL SYSTEMS.</p>
        <div class="socials">
            <a href="https:/instagram.com/fiouue" target="_blank">INSTAGRAM</a>
            <a href="#">WHATSAPP</a>
        </div>
    </footer>

    <script>
    const slides = document.querySelectorAll('.hero-slide');
    let currentSlide = 0;

    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }

    setInterval(nextSlide, 2000); // Ganti gambar tiap 5 detik
    </script>
</body>
</html>