<?php
session_start();
require_once 'config.php'; // Pastikan ini mengarah ke file konfigurasi yang benar

// Koneksi ke database
$servername = "localhost"; // Ganti dengan nama server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "yayasan_amal"; // Nama database yang telah dibuat

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data program dari database
$sql = "SELECT id, nama_program, deskripsi, target_dana, jumlah_terkumpul, foto FROM program";
$result = $conn->query($sql);

// Cek apakah query berhasil
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Zakat, Infaq, dan Shodaqoh</title>
    <link rel="stylesheet" href="style.css"> <!-- Link ke file CSS -->
    <style>
        header {
            background: #35424a;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }
        main {
            padding: 20px;
        }
        .program-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .program-item {
            background: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            margin: 10px;
            padding: 15px;
            width: calc(33% - 40px); /* 3 kolom */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .program-item:hover {
            transform: scale(1.05);
        }
        .program-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .donate-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #28a745; /* Warna hijau */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .donate-button:hover {
            background-color: #218838; /* Warna hijau lebih gelap saat hover */
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background: #35424a;
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
        <h1>Program Zakat, Infaq, dan Shodaqoh</h1>
    </header>

    <main>
        <h2>Daftar Program</h2>
        <div class="program-list">
            <?php
            if ($result->num_rows > 0) {
                // Output data dari setiap baris
                while($row = $result->fetch_assoc()) {
                    echo "<div class='program-item'>";
                    echo "<img src='" . htmlspecialchars($row["foto"]) . "' alt='" . htmlspecialchars($row["nama_program"]) . "'>"; // Menampilkan foto
                    echo "<h3>" . htmlspecialchars($row["nama_program"]) . "</h3>";
                    echo "<p>" . htmlspecialchars($row["deskripsi"]) . "</p>";
                    echo "<p>Target Dana: Rp " . number_format($row["target_dana"], 2, ',', '.') . "</p>";
                    echo "<p>Jumlah Terkumpul: Rp " . number_format($row["jumlah_terkumpul"], 2, ',', '.') . "</p>";
                    echo "<a class='donate-button' href='donasi.php?id=" . $row["id"] . "'>Berdonasi</a>"; // Tombol berdonasi
                    echo "</div>";
                }
            } else {
                echo "<p>Tidak ada program yang tersedia.</p>";
            }
            ?>
        </div>
    </main>

    

</body>
</html>

<?php
$conn->close(); // Menutup koneksi database
?>