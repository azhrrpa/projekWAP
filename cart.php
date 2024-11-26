<?php
session_start();
include('database/connection.php');

// Fungsi untuk menghapus produk dari keranjang
function removeFromCart($productId) {
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['productId'] == $productId) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
}

// Fungsi untuk menghitung total harga keranjang
function calculateTotal() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            // Asumsikan bahwa harga produk ada dalam $item['price']
            $total += $item['quantity'] * $item['price'];
        }
    }
    return $total;
}

// Proses menghapus produk dari keranjang
if (isset($_POST['remove_from_cart'])) {
    $productId = $_POST['product_id'];
    removeFromCart($productId);
    header('Location: cart.php'); // Reload keranjang
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .cart-container {
            margin-top: 30px;
        }
        .cart-item {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .total-container {
            margin-top: 30px;
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-remove {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .btn-remove:hover {
            background-color: #c0392b;
        }
        .btn-checkout {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-checkout:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <div class="container cart-container">
        <h2>Keranjang Belanja</h2>
        
        <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <div class="row">
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="col-md-4">
                        <div class="cart-item">
                            <p><strong>Produk ID:</strong> <?= $item['productId'] ?></p>
                            <p><strong>Jumlah:</strong> <?= $item['quantity'] ?></p>
                            <p><strong>Harga Satuan:</strong> Rp. <?= number_format($item['price'], 0, ',', '.') ?></p>
                            <form action="cart.php" method="POST" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?= $item['productId'] ?>">
                                <button type="submit" name="remove_from_cart" class="btn-remove">Hapus</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="total-container">
                <h4>Total: Rp. <?= number_format(calculateTotal(), 0, ',', '.') ?></h4>
                <a href="checkout.php" class="btn btn-checkout">Checkout</a>
            </div>
            
        <?php else: ?>
            <p>Keranjang Anda kosong.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
