<?php
session_start();

// Hancurkan semua data sesi
session_destroy();

// Arahkan ke halaman login
header("Location: ../views/login.php");
exit();
?>
