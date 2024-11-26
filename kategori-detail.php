<?php
// Include file koneksi
include('database/connection.php');

// Buat objek dari ConnectionDatabase
$db = new ConnectionDatabase();

// Ambil kategori dari URL
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Query untuk mengambil data produk berdasarkan kategori
$query = "SELECT * FROM obat WHERE kategori = ?";
$stmt = $db->connection->prepare($query);
$stmt->bind_param('s', $kategori);
$stmt->execute();
$result = $stmt->get_result();

$obatList = [];
while ($row = $result->fetch_assoc()) {
    $obatList[] = $row;
}

$stmt->close();
$db->closeConnection(); // Menutup koneksi
?>

<?php include('header.php'); ?>

<main role="main" class="container mt-5 pt-5">
    <h2>Obat Kategori: <?= ucfirst(str_replace("&", " & ", $kategori)) ?></h2>
    <div class="row">
        <?php if (count($obatList) > 0): ?>
            <?php foreach ($obatList as $obat): ?>
                <div class="col-md-3">
                    <div class="category-box">
                        <img src="<?= $obat['image'] ?>" alt="<?= $obat['nama_obat'] ?>" class="img-fluid mb-3">
                        <h5><?= $obat['nama_obat'] ?></h5>
                        <p>Harga: <?= number_format($obat['harga'], 0, ',', '.') ?> IDR</p>
                        
                        <!-- Tombol "+" dan "-" untuk menambah/mengurangi jumlah produk -->
                        <div class="quantity-selector">
                            <button class="btn btn-outline-secondary" onclick="updateQuantity('<?= $obat['id_obat'] ?>', -1)">-</button>
                            <input type="text" id="qty-<?= $obat['id_obat'] ?>" value="0" class="quantity-input" readonly>
                            <button class="btn btn-outline-secondary" onclick="updateQuantity('<?= $obat['id_obat'] ?>', 1)">+</button>
                        </div>

                        <!-- Tombol untuk menambahkan ke keranjang -->
                        <button class="btn btn-primary mt-3" onclick="addToCart('<?= $obat['id_obat'] ?>')">Tambah ke Keranjang</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Tidak ada produk dalam kategori ini.</p>
        <?php endif; ?>
    </div>
</main>

<?php include('footer.php'); ?>

<script>
// Fungsi untuk menambah atau mengurangi jumlah produk
function updateQuantity(productId, change) {
    var qtyInput = document.getElementById('qty-' + productId);
    var currentQty = parseInt(qtyInput.value);
    currentQty += change;
    
    if (currentQty < 0) currentQty = 0; // Pastikan tidak ada jumlah negatif
    qtyInput.value = currentQty;
}

// Fungsi untuk menambah produk ke keranjang (mengirim data ke server)
function addToCart(productId) {
    var qty = document.getElementById('qty-' + productId).value;

    if (qty > 0) {
        // Mengirim data produk ke server dengan AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'add_to_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText); // Menampilkan pesan balasan dari server
            }
        };
        xhr.send('product_id=' + productId + '&quantity=' + qty);
    } else {
        alert('Silakan pilih jumlah produk terlebih dahulu!');
    }
}
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}
</script>

<style>
    .category-box {
        background-color: #f3f3f3;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        text-align: center;
    }

    .category-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }

    .category-box img {
        width: 150px;
        height: 150px;
        object-fit: contain;
        margin-bottom: 5px;
    }

    h5 {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-top: 10px;
    }

    p {
        font-size: 16px;
        color: #777;
    }

    h2 {
        font-size: 20px;
        margin-bottom: 50px;
    }

    .quantity-selector {
        margin-top: 10px;
    }

    .quantity-input {
        width: 50px;
        text-align: center;
        margin: 0 10px;
    }
</style>
