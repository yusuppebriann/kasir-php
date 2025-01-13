<?php
session_start();

// Database connection (pastikan Anda sudah membuat koneksi database yang sesuai)
$servername = "localhost";
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "app_kasir"; // Nama database yang baru

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Mencegah SQL Injection
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

// Cek apakah username dan password cocok
$sql = "SELECT * FROM users WHERE username = '$username' AND password = MD5('$password')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Pengguna ditemukan, set session login
    $_SESSION['admin_logged_in'] = true;
    header('Location: ../dashboard/index.php'); // Arahkan ke halaman dashboard
    exit();
} else {
    // Pengguna tidak ditemukan, set session error
    $_SESSION['login_error'] = "Username atau password salah!";
    header('Location: ../views/login.php'); // Arahkan kembali ke halaman login
    exit();
}

// Tutup koneksi
$conn->close();
?>
