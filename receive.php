<?php
session_start();
include('header.php');
include_once 'database/connection.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id_pengguna = $_SESSION['user_id'];

// Ambil data keranjang untuk pengguna tertentu
$sql = "SELECT 
            cart.id AS cart_id,
            produk.id AS id_produk,
            produk.nama_produk,
            produk.gambar,
            cart.jumlah,
            cart.total_harga
        FROM cart
        INNER JOIN produk ON cart.id_produk = produk.id
        WHERE cart.id_pengguna = $id_pengguna";

$result = $conn->query($sql);
$items = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pengiriman = $_POST['pengiriman'];
    $pembayaran = $_POST['pembayaran'];

    // Hitung total harga
    $total_harga = array_sum(array_column($items, 'total_harga'));

    // Buat entri baru di tabel `pesanan`
    $conn->query("INSERT INTO pesanan (id_pengguna, total_harga)
                VALUES ($id_pengguna, $total_harga)");
    
    if ($conn->error) {
        die("Error creating order: " . $conn->error);
    }

    // Ambil ID pesanan terakhir yang dimasukkan
    $id_pesanan = $conn->insert_id;

    // Pindahkan data dari `cart` ke `detail_pesanan`
    foreach ($items as $item) {
        $conn->query("INSERT INTO detail_pesanan (id_pesanan, id_produk, jumlah, subtotal, pengiriman, pembayaran) 
                    VALUES ($id_pesanan, {$item['id_produk']}, {$item['jumlah']}, {$item['total_harga']}, '$pengiriman', '$pembayaran')");
        
        if ($conn->error) {
            die("Error inserting into detail_pesanan: " . $conn->error);
        }
    }

    // Hapus data dari `cart`
    $conn->query("DELETE FROM cart WHERE id_pengguna = $id_pengguna");

    if ($conn->error) {
        die("Error deleting cart: " . $conn->error);
    }

    // Redirect ke halaman complete.php setelah checkout berhasil
    header("Location: complete.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Checkout Overview</h1>

    <div class="cart-items">
        <?php if (!empty($items)): ?>
            <?php foreach ($items as $item): ?>
                <div class="cart-item">
                    <img src="<?= $item['gambar'] ?>" alt="<?= $item['nama_produk'] ?>" width="100">
                    <div>
                        <h2><?= $item['nama_produk'] ?></h2>
                        <p>Jumlah: <?= $item['jumlah'] ?></p>
                        <p>Total Harga: Rp<?= number_format($item['total_harga'], 0, ',', '.') ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Keranjang kosong.</p>
        <?php endif; ?>
    </div>

    <?php if (!empty($items)): ?>
        <form action="" method="POST">
            <h2>Opsi Pengiriman</h2>
            <select name="pengiriman" required>
                <option value="JNE">JNE</option>
                <option value="SiCepat">SiCepat</option>
                <option value="Pos Indonesia">Pos Indonesia</option>
            </select>

            <h2>Metode Pembayaran</h2>
            <select name="pembayaran" required>
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="E-Wallet">E-Wallet</option>
                <option value="COD">COD (Cash on Delivery)</option>
            </select>

            <button type="submit" name="checkout">Buat Pesanan</button>
        </form>
    <?php endif; ?>
</body>

<style>
    body {
    font-family: Arial, sans-serif;
    margin: 20px;
    background-color: #f9f9f9;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

.cart-items, form {
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.cart-item {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.cart-item img {
    margin-right: 20px;
    border-radius: 8px;
    width: 80px;
    height: 80px;
    object-fit: cover;
}

.cart-item h2 {
    margin: 0;
    font-size: 18px;
    color: #333;
}

.cart-item p {
    margin: 5px 0;
    color: #666;
}

form h2 {
    margin-bottom: 10px;
    font-size: 18px;
    color: #333;
}

form select, button {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
}

button {
    background-color: #ff4081;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #e53672;
}

.cart-item:last-child {
    border-bottom: none;
}

p {
    font-size: 16px;
}
</style>

</html>
