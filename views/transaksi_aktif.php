<?php
session_start();

// Pastikan data sudah ada atau terhubung dengan database jika perlu
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Transaksi</title>

    <!-- Link ke CDN Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fc;
            margin: 0;
            padding: 0;
        }

        .main-content {
            padding: 30px;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .form-control {
            margin-bottom: 10px;
        }

        .btn-transaction {
            width: 100%;
            margin-top: 20px;
        }

        .card {
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<!-- Main Content -->
<div class="container">
    <h2 class="mb-4">Halaman Transaksi</h2>

    <!-- Form Transaksi -->
    <div class="card">
        <div class="card-header">
            Daftar Barang Transaksi
        </div>
        <div class="card-body">
            <!-- Tabel untuk menampilkan data transaksi -->
            <form action="penjualan.php" method="POST">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Diterima</th>
                            <th>Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" name="id_barang[]" placeholder="ID Barang"></td>
                            <td><input type="text" class="form-control" name="nama_barang[]" placeholder="Nama Barang"></td>
                            <td><input type="number" class="form-control harga" name="harga[]" placeholder="Harga" oninput="updateSubtotal(0)"></td>
                            <td><input type="number" class="form-control jumlah" name="jumlah[]" placeholder="Jumlah" oninput="updateSubtotal(0)"></td>
                            <td><input type="number" class="form-control subtotal" name="subtotal[]" placeholder="Subtotal" readonly></td>
                            <td><input type="number" class="form-control diterima" name="diterima[]" placeholder="Diterima" oninput="updateKembali(0)"></td>
                            <td><input type="number" class="form-control kembali" name="kembali[]" placeholder="Kembali" readonly></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Total -->
                <div class="d-flex justify-content-end">
                    <h4>Total: <span id="totalHarga">0</span></h4>
                </div>

                <!-- Tombol submit transaksi -->
                <button type="submit" class="btn btn-success btn-transaction">Proses Transaksi</button>
            </form>
        </div>
    </div>
</div>

<!-- Script untuk menghitung subtotal dan kembalian -->
<script>
    function updateSubtotal(index) {
        const harga = parseFloat(document.querySelectorAll('.harga')[index].value) || 0;
        const jumlah = parseFloat(document.querySelectorAll('.jumlah')[index].value) || 0;
        const subtotal = document.querySelectorAll('.subtotal')[index];
        const subtotalValue = harga * jumlah;
        subtotal.value = parseInt(subtotalValue);  // Menggunakan parseInt untuk menghilangkan desimal
        updateTotal();
    }

    function updateKembali(index) {
        const diterima = parseFloat(document.querySelectorAll('.diterima')[index].value) || 0;
        const subtotal = parseFloat(document.querySelectorAll('.subtotal')[index].value) || 0;
        const kembali = document.querySelectorAll('.kembali')[index];
        const kembaliValue = diterima - subtotal;
        kembali.value = parseInt(kembaliValue);  // Menggunakan parseInt untuk menghilangkan desimal
    }

    function updateTotal() {
        let total = 0;
        const subtotals = document.querySelectorAll('.subtotal');
        subtotals.forEach(subtotal => {
            total += parseFloat(subtotal.value) || 0;
        });
        document.getElementById('totalHarga').textContent = parseInt(total);  // Menggunakan parseInt untuk menghilangkan desimal
    }
</script>

<!-- Script Bootstrap JS dan Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
