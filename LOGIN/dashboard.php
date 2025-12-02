<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../LOGIN/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="dashboard-container">
        <?php
        // Menampilkan sambutan dengan echo
        echo "<h2>Selamat datang, " . htmlspecialchars($_SESSION['username']) . "!</h2>";
        ?>

        <p>Role: <?php echo htmlspecialchars($_SESSION['role']); ?></p>

        <div class="button-group">
            <a href="../penjualan/array.php" class="btn">➡️ Masuk ke Halaman Penjualan</a>
            <a href="logout.php" class="btn logout">🚪 Logout</a>
        </div>
    </div>

</body>
</html>
