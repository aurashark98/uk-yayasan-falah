<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lazismu</title>
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

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h2 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .login-header p {
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

        .login-button {
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

        .login-button:hover {
            transform: translateY(-2px);
        }

        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
        }

        .login-footer a {
            color: #00b09b;
            text-decoration: none;
            font-weight: 500;
        }

        .login-footer a:hover {
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
        $username = $_POST['username']; // Input username
        $email = $_POST['email']; // Input email
        $password = $_POST['password']; // Input password

        try {
            // Koneksi ke database
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cek kredensial pengguna
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Login berhasil
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: welcome.php"); // Ganti dengan halaman yang ingin dituju setelah login
                exit();
            } else {
                echo "<script>alert('Username atau email atau password salah.');</script>";
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
   
    ?>

    <div class="login-container">
        <div class="login-header">
            <h2>Masuk ke Akun Anda</h2>
            <p>Silakan masukkan username atau email dan password Anda</p>
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
            <button type="submit" class="login-button">Masuk</button>
        </form>
        
        <div class="login-footer">
            <p>Belum punya akun? <a href="register.php">Daftar Sekarang</a></p>
        </div>
    </div>
</body>
</html>