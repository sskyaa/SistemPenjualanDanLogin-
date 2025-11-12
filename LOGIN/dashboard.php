<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
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
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
    <p>Role: <?php echo $_SESSION['role']; ?></p>
    <a href="logout.php">Logout</a>
</div>

</body>
</html>
