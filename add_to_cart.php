<?php
session_start();

include('database/connection.php');

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    echo "Silakan login terlebih dahulu!";
    exit;
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari sesi
$productId = isset($_POST['product_id']) ? (int) $_POST['product_id'] : null;
$quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : null;

// Validasi input
if (!$productId || $quantity <= 0) {
    echo "Data tidak valid!";
    exit;
}

// Ambil informasi produk (harga dan nama produk)
$query = "SELECT nama_produk, harga FROM produk WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Produk tidak ditemukan!";
    exit;
}

$product = $result->fetch_assoc();
$nama_produk = $product['nama_produk'];
$harga = $product['harga'];
$total_harga = $harga * $quantity; // Tambahkan perhitungan total harga

// Cek apakah produk sudah ada di tabel cart
$checkQuery = "SELECT * FROM cart WHERE id_pengguna = ? AND id_produk = ?";
$checkStmt = $conn->prepare($checkQuery);
$checkStmt->bind_param('ii', $user_id, $productId);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    // Jika produk sudah ada, update jumlah dan total harga
    $updateQuery = "UPDATE cart SET jumlah = jumlah + ?, total_harga = total_harga + (? * ?) WHERE id_pengguna = ? AND id_produk = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param('iiiii', $quantity, $harga, $quantity, $user_id, $productId);
    if ($updateStmt->execute()) {
        echo "Produk berhasil diperbarui di keranjang!";
    } else {
        echo "Gagal memperbarui keranjang: " . $conn->error;
    }
} else {
    // Jika produk belum ada, tambahkan produk baru
    $insertQuery = "INSERT INTO cart (id_pengguna, id_produk, jumlah, total_harga) VALUES (?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param('iiii', $user_id, $productId, $quantity, $total_harga);
    if ($insertStmt->execute()) {
        echo "Produk berhasil ditambahkan ke keranjang!";
    } else {
        echo "Gagal menambahkan produk ke keranjang: " . $conn->error;
    }
}

?>
