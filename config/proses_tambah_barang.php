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

// Ambil data dari form
$nama_barang = $_POST['nama_barang'];
$kategori = $_POST['kategori'];
$harga_jual = $_POST['harga_jual'];
$harga_beli = $_POST['harga_beli'];
$stok = $_POST['stok'];
$satuan = $_POST['satuan']; // Menambahkan satuan

// Query untuk menambah barang
$sql = "INSERT INTO barang (nama_barang, kategori, harga_jual, harga_beli, stok, satuan) 
        VALUES ('$nama_barang', '$kategori', '$harga_jual', '$harga_beli', '$stok', '$satuan')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "Barang berhasil ditambahkan!";
    header("Location: ../views/barang.php");
} else {
    $_SESSION['error'] = "Terjadi kesalahan: " . $conn->error;
    header("Location: ../views/barang.php");
}

$conn->close();
?>
