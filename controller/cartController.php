<?php
session_start();
include_once 'database/connection.php';
include_once 'database/cartModel.php';
include_once 'cartController.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id_pengguna = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_to_cart'])) {
        $id_produk = $_POST['id_produk'];
        $jumlah = $_POST['jumlah'] ?? 1;
        addToCart($id_pengguna, $id_produk, $jumlah);
    } elseif (isset($_POST['update_cart'])) {
        $cart_id = $_POST['id'];
        $jumlah = $_POST['jumlah'];
        updateCartItem($cart_id, $jumlah);
    } elseif (isset($_POST['delete_item'])) {
        $cart_id = $_POST['id'];
        deleteCartItem($cart_id);
    } elseif (isset($_POST['clear_cart'])) {
        clearCart($id_pengguna);
    } elseif (isset($_POST['checkout'])) {
        checkout($id_pengguna);
    }
}

// Ambil isi keranjang
$cart_items = getCartItems($id_pengguna);
$total_harga = array_sum(array_column($cart_items, 'subtotal'));
?>
