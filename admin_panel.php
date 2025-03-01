<?php
include 'configadmin.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Panel Admin - Pengguna</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Created At</th>
            <th>Aksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['password']}</td>
                        <td>{$row['created_at']}</td>
                        <td>
                            <a href='edit.php?id={$row['id']}'>Edit</a> | 
                            <a href='delete.php?id={$row['id']}'>Hapus</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tidak ada pengguna.</td></tr>";
        }
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $username = "root"; // Ganti sesuai dengan user database Anda
    $password = ""; // Ganti sesuai dengan password database Anda
    $dbname = "login_form";

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil data dari form
    $user = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // SQL untuk menambah pengguna
    $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Pengguna berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

        ?>
    </table>
</body>
</html>


}

<?php
$conn->close();
?>