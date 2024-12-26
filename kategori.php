<?php
include('database/connection.php');
include('navbar.php');
include('header.php'); 

// Validasi koneksi
if (!$db->connection) {
    die("Koneksi ke database gagal.");
}

// Query untuk mengambil semua data produk
$query = "SELECT produk.*, kategori.nama_kategori 
          FROM produk 
          LEFT JOIN kategori ON produk.id_kategori = kategori.id";
$result = $db->connection->query($query);

$produkList = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produkList[] = $row;
    }
} else {
    die("Gagal mengambil data produk: " . $db->connection->error);
}

// Tutup koneksi
$db->closeConnection();
?>

<main role="main" class="container mt-5 pt-5">
    <h2>Semua Produk</h2>
    <div class="row">
        <?php if (count($produkList) > 0): ?>
            <?php foreach ($produkList as $produk): ?>
                <div class="col-md-3">
                    <div class="category-box">
                        <img src="<?= htmlspecialchars($produk['gambar']); ?>" alt="<?= 
                        htmlspecialchars($produk['nama_produk']); ?>"  class="img-fluid mb-3">
                        <h5><?= htmlspecialchars($produk['nama_produk']); ?></h5>
                        <p>Deskripsi: <?= htmlspecialchars($produk['deskripsi'] ?? '-'); ?></p>
                        <p>Harga: <?= number_format($produk['harga'], 0, ',', '.'); ?> IDR</p>

                        <div class="quantity-selector">
                            <button class="btn btn-outline-secondary" onclick="updateQuantity('<?= $produk['id']; ?>', -1)">-</button>
                            <input type="text" id="qty-<?= $produk['id']; ?>" value="0" class="quantity-input" readonly>
                            <button class="btn btn-outline-secondary" onclick="updateQuantity('<?= $produk['id']; ?>', 1)">+</button>
                        </div>

                        <button class="btn btn-primary mt-3" onclick="addToCart('<?= $produk['id']; ?>')">Tambah ke Keranjang</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada produk tersedia.</p>
        <?php endif; ?>
    </div>
</main>

<script>
function updateQuantity(productId, change) {
    var qtyInput = document.getElementById('qty-' + productId);
    var currentQty = parseInt(qtyInput.value);
    currentQty += change;
    if (currentQty < 0) currentQty = 0;
    qtyInput.value = currentQty;
}

function addToCart(productId) {
    var qty = parseInt(document.getElementById('qty-' + productId).value);
    if (qty > 0) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText);
            }
        };
        xhr.send('product_id=' + productId + '&quantity=' + qty);
    } else {
        alert('Silakan pilih jumlah produk terlebih dahulu!');
    }
}
</script>
<style>
body, h2, h5, p {
    margin: 0;
    padding: 0;
}

/* Container utama */
main.container {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

/* Judul */
h2 {
    color: #333;
    font-weight: bold;
    text-align: center;
    margin-bottom: 30px;
    font-size: 2rem;
}

/* Box Produk */
.category-box {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    padding: 20px;
    margin-bottom: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.category-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Gambar produk */
.category-box img {
    width: 80px;
    height: 80px;
    object-fit: contain;
    margin-bottom: 15px;
}

/* Nama produk */
.category-box h5 {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
}

/* Deskripsi kategori dan harga */
.category-box p {
    font-size: 0.9rem;
    color: #777;
}

/* Input quantity */
.quantity-selector {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 10px 0;
}

.quantity-selector button {
    background-color: #eee;
    border: none;
    color: #333;
    font-size: 1rem;
    padding: 5px 10px;
    cursor: pointer;
}

.quantity-selector button:hover {
    background-color: #ddd;
}

.quantity-input {
    width: 40px;
    text-align: center;
    border: 1px solid #ccc;
    margin: 0 5px;
    border-radius: 5px;
}

/* Tombol Tambah Keranjang */
.btn-primary {
    background-color: #ff4e6a;
    border: none;
    font-size: 0.9rem;
    font-weight: bold;
    color: #fff;
    border-radius: 50px;
    padding: 8px 20px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #ff2b4f;
}

</style>