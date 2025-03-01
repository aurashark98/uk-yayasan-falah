<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Yayasan Yatim Piatu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background: #2E8B57;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            text-align: center;
            padding: 20px;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color:rgb(0, 5, 2);
        }

        input[type="number"], input[type="text"] {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background: #35424a;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #45a049;
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

        .form-section {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
        }
    </style>
</head>
<body>
    <header>
        <h1>Donasi</h1>
        <div class="logo">Rumah AYP</div>
       
    </header>
    <div class="container">
        <div class="form-section">
            <h2>Donasi Uang</h2>
            <form method="POST">
                <label for="donasiUang">Jumlah Donasi (Uang):</label><br>
                <input type="number" id="donasiUang" name="donasiUang" placeholder="Masukkan jumlah uang" required><br>
                <button type="submit" name="submitUang">Donasi Uang</button>
            </form>
        </div>

        <div class="form-section">
            <h2>Donasi Sembako</h2>
            <form method="POST">
                <label for="jenisSembako">Jenis Sembako:</label><br>
                <input type="text" id="jenisSembako" name="jenisSembako" placeholder="Masukkan jenis sembako" required><br>
                <label for="donasiSembako">Jumlah Sembako:</label><br>
                <input type="number" id="donasiSembako" name="donasiSembako" placeholder="Masukkan jumlah sembako" required><br>
                <button type="submit" name="submitSembako">Donasi Sembako</button>
            </form>
        </div>

        <?php
        // Koneksi ke database
        $host = 'localhost';
        $db = 'donasi_yayasan'; // Ganti dengan nama database Anda
        $user = 'root'; // Ganti dengan username database Anda
        $pass = ''; // Ganti dengan password database Anda

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['submitUang'])) {
                $donasiUang = $_POST['donasiUang'];
                // Simpan ke database
                $stmt = $pdo->prepare("INSERT INTO donasi (jenis_donasi, jumlah) VALUES (?, ?)");
                $stmt->execute(['uang', $donasiUang]);
                echo "<h3>Terima kasih atas donasi Anda sebesar: Rp " . number_format($donasiUang, 0, ',', '.') . "</h3>";
            } elseif (isset($_POST['submitSembako'])) {
                $jenisSembako = $_POST['jenisSembako'];
                $donasiSembako = $_POST['donasiSembako'];
                // Simpan ke database
                $stmt = $pdo->prepare("INSERT INTO donasi (jenis_donasi, jumlah, jenis_sembako) VALUES (?, ?, ?)");
                $stmt->execute(['sembako', $donasiSembako, $jenisSembako]);
                echo "<h3>Terima kasih atas donasi Anda berupa: $donasiSembako unit $jenisSembako</h3>";
            }
        }
        ?>
    </div>
    >
</body>
</html>