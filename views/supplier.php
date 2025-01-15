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

// Query untuk mengambil data supplier
$sql = "SELECT * FROM supplier";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier - Admin Dashboard</title>

    <!-- Link ke CDN Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: #34495e;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
            z-index: 100;
        }

        .sidebar .sidebar-header {
            padding: 20px;
            text-align: center;
        }

        .sidebar .sidebar-header h2 {
            color: #ecf0f1;
            font-size: 24px;
            font-weight: bold;
        }

        .sidebar-menu li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 18px;
            padding: 12px 20px;
            transition: background-color 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-menu li a:hover {
            background-color: #2980b9;
            border-left: 3px solid #ecf0f1;
        }

        .sidebar-menu li a i {
            margin-right: 10px;
            font-size: 18px;
        }

        /* Konten utama */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .card-header {
            font-size: 22px;
            font-weight: bold;
        }

        .card-body {
            font-size: 18px;
        }

        .card {
            border-radius: 8px;
        }

        .table th {
            background-color: #3b6f8c;
            color: white;
        }

        .table tbody tr:nth-child(odd) {
            background-color: rgba(240, 240, 240, 0.7);
        }

        .table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .table tbody tr:hover {
            background-color: rgba(34, 193, 195, 0.1);
        }

        .btn-add {
            background-color: #28a745;
            color: white;
        }

        .btn-add:hover {
            background-color: #218838;
        }

        .btn-edit {
            background-color: #ffc107;
            color: white;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 0;
            }

            .table th, .table td {
                padding: 10px 8px;
            }

            .btn {
                padding: 8px 12px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar bg-dark text-white p-3">
        <div class="sidebar-header mb-4">
            <h2>WARUNG NGOBAR</h2>
        </div>
        <ul class="sidebar-menu list-unstyled">
            <li><a href="../dashboard/index.php" class="d-flex align-items-center"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="../views/barang.php" class="d-flex align-items-center"><i class="fas fa-cogs"></i> Barang</a></li>
            <li><a href="../views/transaksi.php" class="d-flex align-items-center"><i class="fas fa-credit-card"></i> Transaksi</a></li>
            <li><a href="../views/supplier.php" class="d-flex align-items-center active"><i class="fas fa-truck"></i> Supplier</a></li> <!-- Active menu item -->
            <li><a href="../config/logout.php" class="d-flex align-items-center"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Konten Utama -->
    <div class="main-content">
        <h2>Data Supplier</h2>

        <!-- Button Add Supplier -->
        <div class="mb-4">
            <a href="tambah_supplier.php" class="btn btn-add">
                <i class="fas fa-plus"></i> Tambah Supplier
            </a>
        </div>

        <?php
        if ($result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>No</th>';
            echo '<th>ID</th>';
            echo '<th>Nama Supplier</th>';
            echo '<th>Alamat</th>';
            echo '<th>Kontak</th>';
            echo '<th>Aksi</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['nama_supplier'] . '</td>';
                echo '<td>' . $row['alamat'] . '</td>';
                echo '<td>' . $row['kontak'] . '</td>';
                echo '<td>';
                echo '<a href="edit_supplier.php?id=' . $row['id'] . '" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i> Edit</a> ';
                echo '<a href="hapus_supplier.php?id=' . $row['id'] . '" class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</a>';
                echo '</td>';
                echo '</tr>';
                $no++;
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p class="text-center">Tidak ada data supplier ditemukan.</p>';
        }

        // Pesan sukses atau error jika ada
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        }
        ?>

    </div>

    <!-- Script Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
