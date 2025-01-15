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

// Proses data ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama_supplier = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];

    // Validasi input
    if (empty($nama_supplier) || empty($alamat) || empty($kontak)) {
        $_SESSION['error'] = "Semua kolom harus diisi!";
    } else {
        // Query untuk menyimpan data supplier
        $sql = "INSERT INTO supplier (nama_supplier, alamat, kontak) VALUES ('$nama_supplier', '$alamat', '$kontak')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "Supplier berhasil ditambahkan!";
            header("Location: supplier.php");
            exit;
        } else {
            $_SESSION['error'] = "Gagal menambahkan supplier: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier - Admin Dashboard</title>

    <!-- Link ke CDN Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Custom Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            border-color: #28a745;
            box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.25);
        }

        .btn-submit {
            background-color: #28a745;
            color: white;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Tambah Supplier</h2>

    <!-- Menampilkan pesan jika ada error atau sukses -->
    <?php
    if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        unset($_SESSION['success']);
    }
    ?>

    <!-- Form Tambah Supplier -->
    <div class="card">
        <div class="card-body">
            <form method="POST" action="tambah_supplier.php">
                <div class="mb-3">
                    <label for="nama_supplier" class="form-label">Nama Supplier</label>
                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="kontak" class="form-label">Kontak</label>
                    <input type="text" class="form-control" id="kontak" name="kontak" required>
                </div>
                <button type="submit" class="btn btn-submit w-100"><i class="fas fa-plus"></i> Tambah Supplier</button>
            </form>
        </div>
    </div>
</div>

<!-- Script Bootstrap JS dan Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
