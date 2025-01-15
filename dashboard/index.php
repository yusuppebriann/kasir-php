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

// Query untuk menghitung total barang
$sql = "SELECT COUNT(*) as total_barang FROM barang";  // Menggunakan COUNT untuk menghitung jumlah barang
$result = $conn->query($sql);

// Ambil hasil query
$total_barang = 0;
if ($result && $row = $result->fetch_assoc()) {
    $total_barang = $row['total_barang'];  // Menyimpan total barang
}

// Query untuk menghitung total supplier
$sql = "SELECT COUNT(*) as total_supplier FROM supplier";  // Menggunakan COUNT untuk menghitung jumlah barang
$result = $conn->query($sql);

// Ambil hasil query
$total_supplier = 0;
if ($result && $row = $result->fetch_assoc()) {
    $total_supplier = $row['total_supplier'];  // Menyimpan total supplier
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Menambahkan Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Menambahkan Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
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

    <div class="d-flex">

        <!-- Sidebar -->
        <div class="sidebar bg-dark text-white p-3">
            <div class="sidebar-header mb-4">
                <h2>WARUNG NGOBAR</h2>
            </div>
            <ul class="sidebar-menu list-unstyled">
                <li><a href="#" class="d-flex align-items-center active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li> <!-- Active menu item -->
                <li><a href="../views/barang.php" class="d-flex align-items-center"><i class="fas fa-cogs"></i> Barang</a></li>
                <li><a href="../views/transaksi.php" class="d-flex align-items-center"><i class="fas fa-credit-card"></i> Transaksi</a></li>
                <li><a href="../views/supplier.php" class="d-flex align-items-center"><i class="fas fa-truck"></i> Supplier</a></li>
                <li><a href="../config/logout.php" class="d-flex align-items-center"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-fill">
            <div class="container-fluid">
                <header class="mb-4">
                    <div class="alert alert-info" role="alert">
                        <h1 class="h3">Welcome to the Admin Dashboard</h1>
                    </div>
                </header>

                <!-- Dashboard Overview Section -->
                <section>
                    <h2 class="mb-4">Dashboard Overview</h2>
                    <p>Welcome back, Admin! This is your dashboard overview.</p>

                    <div class="row g-4">
                        <!-- Card 1: Total Barang -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    Total Barang
                                </div>
                                <div class="card-body">
                                <h5 class="card-title"><?php echo $total_barang; ?></h5>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2: Kategori -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="card-header bg-success text-white">
                                    Kategori
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">0</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3: Stok Barang -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="card-header bg-warning text-white">
                                    Stok Barang
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">0</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4: Supplier -->
                        <div class="col-md-3">
                            <div class="card shadow-sm">
                                <div class="card-header bg-danger text-white">
                                    Supplier
                                </div>
                                <div class="card-body">
                                <h5 class="card-title"><?php echo $total_supplier; ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                
                    </table>
                </section>
            </div>
        </div>
    </div>

    <!-- Menambahkan Bootstrap JS dan dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>
