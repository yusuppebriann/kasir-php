<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "app_kasir";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil ID barang dari URL
$id = $_GET['id'];

// Query untuk menghapus data barang berdasarkan ID
$sql = "DELETE FROM barang WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "Barang berhasil dihapus.";
    header("Location: barang.php"); // Kembali ke halaman data barang
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
