
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

        .main-content {
            padding: 30px;
        }

        .card-header {
            font-size: 22px;
            font-weight: bold;
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
    </style>
</head>
<body>

<!-- Sidebar (Jika ada) -->

<div class="main-content">
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
