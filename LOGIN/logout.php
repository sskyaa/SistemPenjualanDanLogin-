<?php
session_start();
session_unset();    // hapus semua variabel session
session_destroy();  // hapus session dari server
header("Location: login.php");
exit;
?>
