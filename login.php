<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EQUIP. | Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">

    <div class="login-container">
        <div class="login-aside">
            <div class="aside-overlay">
                <div class="aside-content">
                    <span class="logo-white">EQUIP.</span>
                    <h1 class="reveal">PUSH YOUR<br>LIMITS.</h1>
                    <p class="reveal" style="animation-delay: 0.2s;">Login untuk akses perlengkapan pro.</p>
                </div>
            </div>
        </div>

        <div class="login-section">
            <div class="login-box">
                <div class="mobile-logo">EQUIP.</div>
                <h2>Selamat Datang</h2>
                <p class="subtitle">Silakan masuk ke akun Anda</p>

                <form action="proses_login.php" method="POST">
                    <div class="form-group">
                        <label>USERNAME</label>
                        <input type="text" name="username" autocomplete="off" placeholder="Username lo..." required>
                    </div>
                    
                    <div class="form-group">
                    <label>PASSWORD</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" id="password" autocomplete="off" placeholder="••••••••" required>
                        <div id="togglePassword" class="eye-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </div>
                      </div>
                    </div>

                    <button type="submit" class="btn-login-new">MASUK KE SISTEM</button>
                    <a href="index.php" class="lnk-back">Kembali ke Beranda</a>
                </form>
            </div>
        </div>
    </div>

    <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        // Toggle tipe input
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Kasih efek visual sedikit pas diklik
        this.classList.toggle('active');
        this.style.opacity = type === 'text' ? '1' : '0.5';
        });
    </script>

</body>
</html>