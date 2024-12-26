<?php
function addToCart($id_pengguna, $id_produk, $jumlah = 1) {
    global $conn;

    $query = "SELECT * FROM cart WHERE id_pengguna = ? AND id_produk = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $id_pengguna, $id_produk);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $query = "UPDATE cart SET jumlah = jumlah + ? WHERE id_pengguna = ? AND id_produk = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iii', $jumlah, $id_pengguna, $id_produk);
    } else {
        $query = "INSERT INTO cart (id_pengguna, id_produk, jumlah) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('iii', $id_pengguna, $id_produk, $jumlah);
    }

    $stmt->execute();
    $stmt->close();
}

function getCartItems($id_pengguna) {
    global $conn;
    $query = "SELECT c.id, c.id_produk, p.nama_produk, p.harga, p.gambar, c.jumlah, (p.harga * c.jumlah) AS subtotal
              FROM cart c
              INNER JOIN produk p ON c.id_produk = p.id
              WHERE c.id_pengguna = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_pengguna);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function updateCartItem($cart_id, $jumlah) {
    global $conn;

    if ($jumlah <= 0) {
        deleteCartItem($cart_id);
    } else {
        $query = "UPDATE cart SET jumlah = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $jumlah, $cart_id);
        $stmt->execute();
        $stmt->close();
    }
}

function deleteCartItem($cart_id) {
    global $conn;

    $query = "DELETE FROM cart WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $cart_id);
    $stmt->execute();
    $stmt->close();
}

function clearCart($id_pengguna) {
    global $conn;

    $query = "DELETE FROM cart WHERE id_pengguna = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id_pengguna);
    $stmt->execute();
    $stmt->close();
}

function checkout($id_pengguna) {
    global $conn;

    $cart_items = getCartItems($id_pengguna);
    if (empty($cart_items)) {
        echo "Keranjang belanja kosong!";
        exit;
    }

    $total_harga = array_sum(array_column($cart_items, 'subtotal'));

    $insert_order_query = "INSERT INTO pesanan (id_pengguna, total_harga, tanggal_pesanan) VALUES (?, ?, NOW())";
    $insert_order_stmt = $conn->prepare($insert_order_query);
    $insert_order_stmt->bind_param('id', $id_pengguna, $total_harga);

    if (!$insert_order_stmt->execute()) {
        echo "Gagal menyimpan pesanan: " . $conn->error;
        exit;
    }

    header("Location: receive.php");
    exit;
}
?>
