 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
 </body>
 </html>