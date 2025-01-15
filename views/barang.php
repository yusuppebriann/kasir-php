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

// Query untuk mengambil data barang
$sql = "SELECT * FROM barang";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang - Admin Dashboard</title>

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
            background-color: #34495e; /* Warna sidebar sesuai dengan index.php */
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
            z-index: 100; /* Agar sidebar selalu di depan konten utama */
        }

        .sidebar .sidebar-header {
            padding: 20px;
            text-align: center;
        }

        .sidebar .sidebar-header h2 {
            color: #ecf0f1;
            font-size: 24px;
            font-weight: bold;
            font-family: 'Arial', sans-serif; /* Menyesuaikan font */
        }

        .sidebar-menu li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 18px; /* Ukuran font sidebar */
            padding: 12px 20px; /* Sesuaikan padding untuk tampilan yang konsisten */
            transition: background-color 0.3s ease;
            border-left: 3px solid transparent; /* Border efek hover */
            font-family: 'Arial', sans-serif; /* Menyesuaikan font */
        }

        .sidebar-menu li a:hover {
            background-color: #2980b9; /* Warna hover yang konsisten */
            border-left: 3px solid #ecf0f1;
        }



        .sidebar-menu li a i {
            margin-right: 10px;
            font-size: 18px;
        }
        

        /* Konten utama */
        .main-content {
            margin-left: 250px; /* Memberikan ruang untuk sidebar */
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

        /* Styling Tabel */
        .table th {
            background-color: #3b6f8c;
            color: white;
            border-top: 3px solid #fff;
            border-bottom: 3px solid #fff;
        }

        .table tbody tr:nth-child(odd) {
            background-color: rgba(240, 240, 240, 0.7);
        }

        .table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .table tbody tr:hover {
            background-color: rgba(34, 193, 195, 0.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Tombol Aksi */
        .btn {
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-edit {
            background-color: #f39c12;
            color: white;
        }

        .btn-edit:hover {
            background-color: #e67e22;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c0392b;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Pesan Error */
        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .no-data {
            text-align: center;
            font-size: 18px;
            color: #e74c3c;
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
                <li><a href="../dashboard/index.php" class="d-flex align-items-center active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li> <!-- Active menu item -->
                <li><a href="../views/barang.php" class="d-flex align-items-center"><i class="fas fa-cogs"></i> Barang</a></li>
                <li><a href="../views/transaksi.php" class="d-flex align-items-center"><i class="fas fa-credit-card"></i> Transaksi</a></li>
                <li><a href="../views/supplier.php" class="d-flex align-items-center"><i class="fas fa-truck"></i> Supplier</a></li>
                <li><a href="../config/logout.php" class="d-flex align-items-center"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>
    <!-- Konten Utama -->
    <div class="main-content">
        <h2>Data Barang</h2>

        <!-- Header Section: Add Button -->
        <div class="header-section">
            <a href="tambah_barang.php" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah Barang
            </a>
        </div>

        <?php
        if (isset($_SESSION['login_error'])) {
            echo "<div class='alert alert-danger'>".$_SESSION['login_error']."</div>";
            unset($_SESSION['login_error']);
        }
        ?>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th>Harga Beli</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['nama_barang']."</td>";
                        echo "<td>".$row['kategori']."</td>";
                        echo "<td>Rp ".number_format($row['harga_jual'], 0, ',', '.')."</td>";
                        echo "<td>Rp ".number_format($row['harga_beli'], 0, ',', '.')."</td>";
                        echo "<td>".$row['stok']."</td>";
                        echo "<td>
                                <a href='edit_barang.php?id=".$row['id']."' class='btn btn-edit btn-sm'><i class='fas fa-edit'></i> Edit</a>
                                <a href='hapus_barang.php?id=".$row['id']."' class='btn btn-delete btn-sm'><i class='fas fa-trash'></i> Hapus</a>
                              </td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='8' class='no-data'>Tidak ada data barang ditemukan.</td></tr>";
                }
                ?>
                <?php
if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}
?>

            </tbody>
        </table>
    </div>

    <!-- Script Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?> 
1w2