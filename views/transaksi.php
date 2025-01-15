<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Transaksi</title>

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
        /* Custom CSS untuk menyesuaikan dengan desain */
        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background-color: #34495e; /* Warna sidebar sesuai dengan index.php */
            width: 250px; /* Lebar sidebar */
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
        }

        .sidebar-menu li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 18px;
            padding: 12px 20px; /* Sesuaikan padding untuk tampilan yang konsisten */
            transition: background-color 0.3s ease;
            border-left: 3px solid transparent; /* Border efek hover */
        }

        .sidebar-menu li a:hover {
            background-color: #2980b9; /* Warna hover yang konsisten */
            border-left: 3px solid #ecf0f1;
        }

        .sidebar-menu li a.active {
            background-color: #2980b9;
            color: white;
            font-weight: bold;
            border-left: 3px solid #ecf0f1;
        }

        .sidebar-menu li a i {
            margin-right: 10px;
            font-size: 18px;
        }

        /* Main Content */
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

        .btn-transaction {
            font-size: 18px;
            padding: 15px 30px;
            margin: 10px;
            width: 100%;
        }

        .btn-penjualan {
            background-color: #f39c12;
            color: white;
        }

        .btn-pembelian {
            background-color: #3498db;
            color: white;
        }

        .navbar {
            background-color: #4e73df;
            color: white;
        }

        .navbar .navbar-brand {
            color: white;
        }

        /* Responsif untuk perangkat mobile */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px; /* Mengurangi lebar sidebar pada layar kecil */
            }
            .main-content {
                margin-left: 0; /* Menghilangkan margin untuk tampilan mobile */
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

<!-- Main Content -->
<div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light mb-4">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
    </nav>

    <h2>Transaksi</h2>

    <div class="card">
        <div class="card-header">
            Pilih Jenis Transaksi
        </div>
        <div class="card-body">
            <a href="penjualan.php" class="btn btn-transaction btn-penjualan">
                <i class="fas fa-cash-register"></i> Penjualan
            </a>
            <a href="pembelian.php" class="btn btn-transaction btn-pembelian">
                <i class="fas fa-cart-plus"></i> Pembelian
            </a>
        </div>
    </div>
</div>

<!-- Script Bootstrap JS dan Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
