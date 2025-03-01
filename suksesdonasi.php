<?php
session_start();

// Redirect jika tidak ada data transaksi
if (!isset($_SESSION['transaction'])) {
    header("Location: index.php");
    exit();
}

$transaction = $_SESSION['transaction'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Berhasil - Lazismu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">Lazismu</a>
        </div>
    </nav>

    <div class="success-container">
        <div class="success-card">
            <h2>Terima Kasih Atas Donasi Anda!</h2>
            <div class="success-details">
                <p>ID Transaksi: #<?php echo $transaction['id']; ?></p>
                <p>Nama: <?php echo htmlspecialchars($transaction['name']); ?></p>
                <p>Jumlah: Rp <?php echo number_format($transaction['amount'], 0, ',', '.'); ?></p>
                <p>Metode Pembayaran: <?php echo htmlspecialchars($transaction['payment_method']); ?></p>
            </div>

            <div class="payment-instructions">
                <h3>Instruksi Pembayaran:</h3>
                <?php if (strpos($transaction['payment_method'], 'transfer_') === 0): ?>
                    <p>Silakan transfer ke rekening berikut:</p>
                    <?php if ($transaction['payment_method'] === 'transfer_bca'): ?>
                        <p>BCA: 1234567890</p>
                    <?php elseif ($transaction['payment_method'] === 'transfer_mandiri'): ?>
                        <p>Mandiri: 0987654321</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Silakan buka aplikasi <?php echo $transaction['payment_method']; ?> Anda</p>
                <?php endif; ?>
            </div>

            <a href="index.php" class="btn-home">Kembali ke Beranda</a>
        </div>
    </div>

    <?php
    // Hapus data transaksi dari session setelah ditampilkan
    unset($_SESSION['transaction']);
    ?>
</body>
</html>
