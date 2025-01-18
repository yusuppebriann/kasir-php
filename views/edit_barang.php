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

// Query untuk mengambil data barang berdasarkan ID
$sql = "SELECT * FROM barang WHERE id = $id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Barang tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menangani data yang dikirim dari form
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];

    // Query untuk memperbarui data barang
    $update_sql = "UPDATE barang SET 
                    nama_barang = '$nama_barang', 
                    kategori = '$kategori', 
                    harga_jual = '$harga_jual', 
                    harga_beli = '$harga_beli', 
                    stok = '$stok' 
                    WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        $_SESSION['success'] = "Barang berhasil diperbarui.";
        header("Location: barang.php"); // Kembali ke halaman data barang
        exit();
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Barang</h2>

    <form action="../config/proses_tambah_barang.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="form-group">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required>
    </div>
    <div class="form-group">
        <label for="kategori">Kategori</label>
        <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $row['kategori']; ?>" required>
    </div>
    <div class="form-group">
        <label for="harga_jual">Harga Jual</label>
        <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?php echo $row['harga_jual']; ?>" required>
    </div>
    <div class="form-group">
        <label for="harga_beli">Harga Beli</label>
        <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="<?php echo $row['harga_beli']; ?>" required>
    </div>
    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $row['stok']; ?>" required>
    </div>
    <div class="form-group">
        <label for="satuan">Satuan</label> <!-- Menambahkan input untuk satuan -->
        <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $row['satuan']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Barang</button>
</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
