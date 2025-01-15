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

// Mengecek apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data supplier berdasarkan ID
    $sql_delete = "DELETE FROM supplier WHERE id = $id";

    if ($conn->query($sql_delete) === TRUE) {
        $_SESSION['success'] = "Data supplier berhasil dihapus";
    } else {
        $_SESSION['error'] = "Gagal menghapus data supplier: " . $conn->error;
    }
}

header("Location: supplier.php");
exit;

$conn->close();
?>
