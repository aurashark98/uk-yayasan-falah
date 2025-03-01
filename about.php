<?php
session_start();
require_once 'config.php'; // Pastikan ini mengarah ke file konfigurasi yang benar
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Saya</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS -->
    <style>
        header {
            background: #2E8B57;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }
        main {
            padding: 20px;
        }
        .about-section {
            background: #ffffff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background: #2E8B57;
            color: #ffffff;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<nav class="navbar">
        <div class="logo">Rumah AYP</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">Tentang Kami</a></li>
            <li><a href="program.php">Program</a></li>
            <li><a href="berita.php">Berita</a></li>
        </ul>
        <div class="auth-buttons">
            <?php if(isset($_SESSION['user_id'])): ?>
                <div class="user-info">
                    <?php echo htmlspecialchars($_SESSION['username']); ?>
                </div>
                <form action="logout.php" method="POST" style="display:inline;">
                    <button type="submit" class="btn btn-register">Logout</button>
                </form>
            <?php else: ?>
                <a href="register.php" class="btn btn-login">Register</a>
                <a href="login.php" class="btn btn-register">Login</a>
            <?php endif; ?>
        </div>
    </nav>
    <header>
        <h1>Tentang Saya</h1>
    </header>

    <main>
        <div class="about-section">
            <h2>Data Diri</h2>
            <p><strong>Nama:</strong> Irsyad Falah M.P</p>
            <p><strong>Tanggal Lahir:</strong> 21 Maret 2009</p>
            <p><strong>Alamat:</strong> JL. Jati Selatan 3 No 39</p>
            <p><strong>Sekolah:</strong> SMK Telkom Sidoarjo</p>
            <p><strong>Status:</strong>pelajar</p>
            <p><strong>Email:</strong> falahmotor37@gmail.com</p>
            <p><strong>Telepon:</strong> +62 85808436591</p>

            <h3>Biografi Singkat</h3>
            <p>Saya adalah seorang pebisnis, yang ingin membantu anak anak yatim dan piatu</p>
        </div>
    </main>


    
</body>
</html>