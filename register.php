<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Rumah AYP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #00b09b, #96c93d);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .register-container {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }

        .register-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .register-header h2 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .register-header p {
            color: #666;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #eee;
            border-radius: 8px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #00b09b;
            outline: none;
        }

        .register-button {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #00b09b, #96c93d);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .register-button:hover {
            transform: translateY(-2px);
        }

        .register-footer {
            text-align: center;
            margin-top: 1.5rem;
        }

        .register-footer a {
            color: #00b09b;
            text-decoration: none;
            font-weight: 500;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    // Koneksi ke database
    $host = 'localhost';
    $db = 'login_form'; // Ganti dengan nama database Anda
    $user = 'root'; // Ganti dengan username database Anda
    $pass = ''; // Ganti dengan password database Anda

    // Cek apakah form disubmit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        try {
            // Koneksi ke database
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cek apakah email atau username sudah ada
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
            $stmt->execute([$email, $username]);
            $existingUser = $stmt->fetch();

            if ($existingUser) {
                echo "<script>alert('Email atau username sudah terdaftar. Silakan gunakan yang lain.');</script>";
            } else {
                // Menyimpan pengguna baru ke database
                $stmt = $pdo->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
                $stmt->execute([$email, $username, $password]);

                // Pengalihan ke halaman login setelah registrasi berhasil
                echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    ?>

    <div class="register-container">
        <div class="register-header">
            <h2>Buat Akun Baru</h2>
            <p>Bergabunglah dengan kami untuk berbagi kebaikan</p>
        </div>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="register-button">Daftar Sekarang</button>
        </form>
        
        <div class="register-footer">
            <p>Sudah punya akun? <a href="login.php">Masuk</a></p>
        </div>
    </div>
</body>
</html>