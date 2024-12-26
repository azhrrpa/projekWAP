<?php
include_once('connection.php');

// Redirect if not logged in as admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_product'])) {
        $nama_produk = $_POST['nama_produk'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $id_kategori = $_POST['id_kategori'];
        $gambar = '';

        if (!empty($_FILES['gambar']['name'])) {
            $gambar = 'img/' . basename($_FILES['gambar']['name']);
            move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar);
        }

        $stmt = $db->connection->prepare(
            "INSERT INTO produk (nama_produk, deskripsi, harga, stok, gambar, id_kategori) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('ssdisi', $nama_produk, $deskripsi, $harga, $stok, $gambar, $id_kategori);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST['edit_product'])) {
        $id = $_POST['id'];
        $nama_produk = $_POST['nama_produk'];
        $deskripsi = $_POST['deskripsi'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $id_kategori = $_POST['id_kategori'];
        $gambar = '';

        if (!empty($_FILES['gambar']['name'])) {
            $gambar = 'img/' . basename($_FILES['gambar']['name']);
            move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar);
        }

        $stmt = $db->connection->prepare(
            "UPDATE produk SET nama_produk = ?, deskripsi = ?, harga = ?, stok = ?, gambar = ?, id_kategori = ? WHERE id = ?"
        );
        $stmt->bind_param('ssdisii', $nama_produk, $deskripsi, $harga, $stok, $gambar, $id_kategori, $id);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST['delete_product'])) {
        $id = $_POST['id'];
        $stmt = $db->connection->prepare("DELETE FROM produk WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }
}

if (isset($_POST['edit_product_form'])) {
    $id = $_POST['id'];
    $stmt = $db->connection->prepare("SELECT * FROM produk WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product_to_edit = $result->fetch_assoc();
    $stmt->close();
}

// Logout Logic
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Fetch categories
$categories = $db->connection->query("SELECT * FROM kategori")->fetch_all(MYSQLI_ASSOC);

// Fetch products
$products = $db->connection->query(
    "SELECT produk.*, kategori.nama_kategori FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id"
)->fetch_all(MYSQLI_ASSOC);

?>