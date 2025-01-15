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

    // Query untuk mengambil data supplier berdasarkan ID
    $sql = "SELECT * FROM supplier WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan";
        exit;
    }
} else {
    echo "ID tidak ditemukan";
    exit;
}

// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];

    // Query untuk mengupdate data supplier
    $sql_update = "UPDATE supplier SET nama_supplier = '$nama_supplier', alamat = '$alamat', kontak = '$kontak' WHERE id = $id";

    if ($conn->query($sql_update) === TRUE) {
        $_SESSION['success'] = "Data supplier berhasil diperbarui";
        header("Location: supplier.php");
        exit;
    } else {
        $_SESSION['error'] = "Gagal memperbarui data supplier: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Supplier</h2>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']);
    }
    ?>
    <form method="POST">
        <div class="mb-3">
            <label for="nama_supplier" class="form-label">Nama Supplier</label>
            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="<?php echo $row['nama_supplier']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" required><?php echo $row['alamat']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="kontak" class="form-label">Kontak</label>
            <input type="text" class="form-control" id="kontak" name="kontak" value="<?php echo $row['kontak']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
