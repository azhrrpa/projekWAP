<?php
include 'controller/cartController.php';
include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <h1>Keranjang Belanja</h1>

        <?php if (!empty($cart_items)): ?>
            <?php foreach ($cart_items as $item): ?>
                <div class="cart-item">
                    <img src="<?php echo $item['gambar'] ?? 'img/default.jpg'; ?>" alt="<?php echo $item['nama_produk']; ?>">
                    <div class="cart-item-details">
                        <h4><?php echo $item['nama_produk']; ?></h4>
                        <p>Harga: Rp <?php echo number_format($item['harga'], 2); ?></p>
                        <p>Subtotal: Rp <?php echo number_format($item['subtotal'], 2); ?></p>
                    </div>
                    <div class="cart-item-actions">
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <input type="number" name="jumlah" value="<?php echo $item['jumlah']; ?>" min="1">
                            <button type="submit" name="update_cart">Update</button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="delete_item">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="total">Total: Rp <?php echo number_format($total_harga, 2); ?></div>

            <div class="cart-buttons">
                <form method="POST">
                    <button type="submit" name="clear_cart">Kosongkan Keranjang</button>
                </form>
                <form method="POST">
                    <button type="submit" name="checkout">Checkout</button>
                </form>
            </div>
        <?php else: ?>
            <p>Keranjang belanja Anda kosong.</p>
        <?php endif; ?>
    </div>
</body>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }
    .container {
        width: 90%;
        margin: 20px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .cart-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
    }
    .cart-item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
    }
    .cart-item-details {
        flex-grow: 1;
        margin-left: 15px;
    }
    .cart-item-details h4 {
        margin: 0 0 5px 0;
        font-size: 16px;
    }
    .cart-item-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .total {
        text-align: right;
        font-size: 18px;
        font-weight: bold;
        margin-top: 15px;
    }
    .cart-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    button {
        padding: 10px 15px;
        background: #F06292;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background: #F06292;
    }
</style>
</html>