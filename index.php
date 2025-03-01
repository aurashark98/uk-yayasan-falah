<?php
session_start();
require_once 'config.php'; // Pastikan ini mengarah ke file konfigurasi yang benar
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah AYP platform donasi</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

    <section class="hero">
        <h1>Berbagi Kebaikan Bersama Rumah AYP</h1>
        <p>Salurkan donasi Anda untuk membantu sesama</p>
        <a href="donation.php" class="btn btn-register">Donasi Sekarang</a>
    </section>

    <section id="donate" class="donations">
        <h2>Program Donasi Terkini</h2>
        <div class="donation-grid">
            <?php
            $donations = $conn->query("SELECT * FROM donations ORDER BY created_at DESC LIMIT 6");
            while($donation = $donations->fetch_assoc()):
            ?>
            <div class="donation-card">
                <img src="<?php echo $donation['image_url']; ?>" alt="<?php echo $donation['title']; ?>">
                <h3><?php echo $donation['title']; ?></h3>
                <p><?php echo substr($donation['description'], 0, 100); ?>...</p>
                <div class="progress-bar">
                    <div class="progress" style="width: <?php echo ($donation['amount_collected']/$donation['target_amount'])*100; ?>%"></div>
                </div>
                <p>Terkumpul: Rp <?php echo number_format($donation['amount_collected']); ?></p>
                <a href="donation.php?id=<?php echo $donation['id']; ?>" class="btn btn-register">Donasi</a>
            </div>
            <?php endwhile; ?>
        </div>
    </section>

    <section class="programs">
        <div class="program-card">
            <div class="program-content">
                <h3>Program Peduli Anak Yatim</h3>
                <div class="quran-quote">
                    <p class="arabic">لَّيْسَ الْبِرَّ أَن تُوَلُّوا وُجُوهَكُمْ قِبَلَ الْمَشْرِقِ وَالْمَغْرِبِ وَلَٰكِنَّ الْبِرَّ مَنْ آمَنَ بِاللَّهِ وَالْيَوْمِ الْآخِرِ وَالْمَلَائِكَةِ وَالْكِتَابِ وَالنَّبِيِّينَ وَآتَى الْمَالَ عَلَىٰ حُبِّهِ ذَوِي الْقُرْبَىٰ وَالْيَتَامَىٰ وَالْمَسَاكِينَ</p>
                    <p class="translation">"Bukanlah menghadapkan wajahmu ke arah timur dan barat itu suatu kebajikan, akan tetapi sesungguhnya kebajikan itu ialah beriman kepada Allah, hari kemudian, malaikat-malaikat, kitab-kitab, nabi-nabi dan memberikan harta yang dicintainya kepada kerabatnya, anak-anak yatim, orang-orang miskin..." (QS. Al-Baqarah: 177)</p>
                </div>
                <div class="program-details">
                    <div class="detail-item">
                        <span class="label">Target Dana:</span>
                        <span class="value">Rp 500.000.000</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Terkumpul:</span>
                        <span class="value">Rp 275.000.000</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" style="width: 55%"></div>
                    </div>
                    <div class="detail-item">
                        <span class="label">Jumlah Donatur:</span>
                        <span class="value">1,234</span>
                    </div>
                </div>
                <div class="program-description">
                    <h4>Tentang Program</h4>
                    <p>Program Peduli Anak Yatim adalah inisiatif untuk membantu pendidikan dan kehidupan anak-anak yatim. Program ini mencakup:</p>
                    <ul>
                        <li>Beasiswa pendidikan</li>
                        <li>Santunan bulanan</li>
                        <li>Pelatihan keterampilan</li>
                        <li>Pembinaan karakter</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</body>
</html>