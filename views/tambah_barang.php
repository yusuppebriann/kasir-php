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

// Proses penambahan barang
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];

    // Validasi input
    if (empty($nama_barang) || empty($kategori) || empty($harga_jual) || empty($harga_beli) || empty($stok)) {
        $_SESSION['error'] = "Semua kolom harus diisi!";
    } else {
        // Query untuk menyimpan data barang ke database
        $sql = "INSERT INTO barang (nama_barang, kategori, harga_jual, harga_beli, stok) VALUES ('$nama_barang', '$kategori', '$harga_jual', '$harga_beli', '$stok')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "Barang berhasil ditambahkan!";
            header("Location: barang.php"); // Arahkan ke halaman daftar barang setelah berhasil
            exit(); // Pastikan proses ini dihentikan setelah redirect
        } else {
            $_SESSION['error'] = "Gagal menambahkan barang: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang - Admin Dashboard</title>
    
    <!-- Link ke CDN Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Optional: Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6e7f80, #e3f2fd);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .btn-custom {
            background: #007bff;
            color: white;
            border-radius: 8px;
            padding: 12px 25px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: #0056b3;
            transform: translateY(-3px);
        }

        .alert {
            margin-top: 20px;
            padding: 12px;
            border-radius: 8px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .form-label {
            font-weight: 500;
            font-size: 16px;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            box-shadow: none;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #007bff;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tambah Barang</h2>
        
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php } ?>

        <?php if (isset($_SESSION['success'])) { ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php } ?>

        <form action="../config/proses_tambah_barang.php" method="POST">
    <div class="form-group">
        <label for="nama_barang">Nama Barang</label>
        <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
    </div>
    <div class="form-group">
        <label for="kategori">Kategori</label>
        <input type="text" class="form-control" id="kategori" name="kategori" required>
    </div>
    <div class="form-group">
        <label for="harga_jual">Harga Jual</label>
        <input type="number" class="form-control" id="harga_jual" name="harga_jual" required>
    </div>
    <div class="form-group">
        <label for="harga_beli">Harga Beli</label>
        <input type="number" class="form-control" id="harga_beli" name="harga_beli" required>
    </div>
    <div class="form-group">
        <label for="stok">Stok</label>
        <input type="number" class="form-control" id="stok" name="stok" required>
    </div>
    <div class="form-group">
        <label for="satuan">Satuan</label> <!-- Menambahkan input untuk satuan -->
        <input type="text" class="form-control" id="satuan" name="satuan" required>
    </div>
    <button type="submit" class="btn btn-primary">Tambah Barang</button>
</form>


        <div class="footer">
            <a href="../views/barang.php">Kembali ke Daftar Barang</a>
        </div>
    </div>

    <!-- Script Bootstrap JS dan Popper.js (Optional but required for some Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
