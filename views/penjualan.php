<?php
session_start();

// Cek jika data POST sudah dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data yang dikirim dari form transaksi
    $id_barang = isset($_POST['id_barang']) ? $_POST['id_barang'] : [];
    $nama_barang = isset($_POST['nama_barang']) ? $_POST['nama_barang'] : [];
    $harga = isset($_POST['harga']) ? $_POST['harga'] : [];
    $jumlah = isset($_POST['jumlah']) ? $_POST['jumlah'] : [];
    $subtotal = isset($_POST['subtotal']) ? $_POST['subtotal'] : [];
    $diterima = isset($_POST['diterima']) ? $_POST['diterima'] : [];
    $kembali = isset($_POST['kembali']) ? $_POST['kembali'] : [];

    // Menyimpan data transaksi ke dalam session untuk diproses lebih lanjut
    $_SESSION['transaksi'] = [
        'id_barang' => $id_barang,
        'nama_barang' => $nama_barang,
        'harga' => $harga,
        'jumlah' => $jumlah,
        'subtotal' => $subtotal,
        'diterima' => $diterima,
        'kembali' => $kembali
    ];

    // Debug untuk melihat data yang diterima
    echo "<h3>Data Transaksi Berhasil Disimpan</h3>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID Barang</th><th>Nama Barang</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th>Diterima</th><th>Kembali</th></tr>";

    for ($i = 0; $i < count($id_barang); $i++) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($id_barang[$i]) . "</td>";
        echo "<td>" . htmlspecialchars($nama_barang[$i]) . "</td>";
        echo "<td>" . number_format($harga[$i], 0, ',', '.') . "</td>";
        echo "<td>" . htmlspecialchars($jumlah[$i]) . "</td>";
        echo "<td>" . number_format($subtotal[$i], 0, ',', '.') . "</td>";
        echo "<td>" . number_format($diterima[$i], 0, ',', '.') . "</td>";
        echo "<td>" . number_format($kembali[$i], 0, ',', '.') . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Data transaksi tidak ditemukan.";
}
?>

<!-- Tombol untuk kembali ke menu transaksi -->
<form action="transaksi.php" method="GET">
    <button type="submit" class="btn btn-primary mt-4">Selesai</button>
</form>
