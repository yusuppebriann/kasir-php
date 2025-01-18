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
        

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .navbar {
            background-color: #4e73df;
            color: white;
        }

        .navbar .navbar-brand {
            color: white;
        }

        h2 {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .card {
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-top: 30px;
        }

        .card-header {
            font-size: 22px;
            font-weight: bold;
            background-color: #f1f1f1;
            color: #333;
        }

        .card-body {
            font-size: 18px;
        }

        .btn-transaction {
            font-size: 18px;
            padding: 15px 30px;
            margin: 10px;
            width: 100%;
            border-radius: 8px;
        }

        .btn-penjualan {
            background-color: #f39c12;
            color: white;
        }

        .btn-pembelian {
            background-color: #3498db;
            color: white;
        }

        /* Add hover effects for the buttons */
        .btn-transaction:hover {
            opacity: 0.9;
            transform: translateY(-3px);
        }

        /* Tombol Transaksi Aktif */
.btn-transaksi-aktif {
    background-color: #8e44ad; /* Warna ungu untuk tombol Transaksi Aktif */
    color: white;
}

.btn-transaksi-aktif:hover {
    opacity: 0.9;
    transform: translateY(-3px);
}


        /* Responsif untuk perangkat mobile */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }
            .main-content {
                margin-left: 0;
            }
            h2 {
                font-size: 24px;
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
        <li><a href="../dashboard/index.php" class="d-flex align-items-center active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
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
    <!-- Menambahkan tombol Transaksi Aktif -->
    <a href="transaksi_aktif.php" class="btn btn-transaction btn-transaksi-aktif">
        <i class="fas fa-sync-alt"></i> Transaksi Aktif
    </a>
</div>

    </div>
</div>

<!-- Script Bootstrap JS dan Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
