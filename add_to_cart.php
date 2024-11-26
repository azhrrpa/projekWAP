<?php
session_start(); // Memulai session

// Include file koneksi
include('database/connection.php');

// Buat objek dari ConnectionDatabase
$db = new ConnectionDatabase();

// Ambil data dari POST
$productId = isset($_POST['product_id']) ? $_POST['product_id'] : null;
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
$userId = $_SESSION['id']; // Ambil ID user dari session

// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    echo "Silakan login terlebih dahulu untuk menambahkan produk ke keranjang.";
    exit(); // Hentikan eksekusi jika belum login
}

if ($productId && $quantity) {
    // Periksa apakah produk sudah ada di keranjang
    $query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
    $stmt = $db->connection->prepare($query);
    $stmt->bind_param('ii', $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Produk sudah ada di keranjang, update quantity
        $query = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
        $stmt = $db->connection->prepare($query);
        $stmt->bind_param('iii', $quantity, $userId, $productId);
        $stmt->execute();
        echo "Produk berhasil diperbarui di keranjang!";
    } else {
        // Produk belum ada di keranjang, insert baru
        $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
        $stmt = $db->connection->prepare($query);
        $stmt->bind_param('iii', $userId, $productId, $quantity);
        $stmt->execute();
        echo "Produk berhasil ditambahkan ke keranjang!";
    }

    $stmt->close();
} else {
    echo "Data tidak lengkap!";
}

$db->closeConnection(); // Menutup koneksi
?>
