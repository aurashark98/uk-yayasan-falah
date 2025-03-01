<?php
// Koneksi ke database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data program dari database
$sql = "SELECT id, nama_program, deskripsi, target_dana FROM program";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Zakat, Infaq, dan Shodaqoh</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Program Zakat, Infaq, dan Shodaqoh</h1>
    </header>

    <main>
        <h2>Daftar Program</h2>
        <ul>
            <?php
            if ($result->num_rows > 0) {
                // Output data dari setiap baris
                while($row = $result->fetch_assoc()) {
                    echo "<li>";
                    echo "<h3>" . $row["nama_program"] . "</h3>";
                    echo "<p>" . $row["deskripsi"] . "</p>";
                    echo "<p>Target Dana: " . $row["target_dana"] . "</p>";
                    echo "<a href='donasi.php?id=" . $row["id"] . "'>Berdonasi</a>";
                    echo "</li>";
                }
            } else {
                echo "<li>Tidak ada program yang tersedia.</li>";
            }
            ?>
        </ul>
    </main>

    <footer>
        <p>&copy; 2025 Yayasan Amal</p>
    </footer>

</body>
</html>

<?php
$conn->close();
?>