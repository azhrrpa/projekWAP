<?php


// Inisialisasi cart jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Hitung jumlah item di keranjang
$cartItemCount = 0;
foreach ($_SESSION['cart'] as $item) {
    $cartItemCount += $item['quantity']; // Asumsi setiap item punya key 'quantity'
}

// Debugging (hapus ini jika tidak diperlukan)
echo '<pre>';
print_r($_SESSION['cart']);
echo 'Cart Item Count: ' . $cartItemCount;
echo '</pre>';
?>

<header>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Ties Pharmacy App</a>

            <!-- Search Bar -->
            <div class="d-flex justify-content-between align-items-center">
                <div class="search-box me-3" style="position: relative; max-width: 400px; width: 100%;">
                    <i class="fas fa-search search-icon" 
                        style="position: absolute; top: 50%; left: 0.75rem; transform: translateY(-50%); color: 828282;"></i>
                    <input type="text" class="form-control" placeholder="Cari Obat..." aria-label="Cari Obat" 
                        style="padding-left: 2.5rem;">
                </div>
            </div>

            <!-- Button Login and SignUp -->
            <div class="d-flex gap-3 ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Navbar untuk pengguna yang sudah login -->
                    <!-- Menampilkan Icon User ketika login -->
                    <a href="profile.php" class="btn btn-outline-primary" id="profileIcon">
                        <i class="bx bx-user"></i> <!-- Icon User -->
                    </a>

                    <!-- Menampilkan tombol Logout -->
                    <a href="logout.php" class="btn btn-danger" id="logoutBtn">Logout</a>
                <?php else: ?>
                    <!-- Jika pengguna belum login -->
                    <a href="login.php" class="btn btn-outline-primary custom-margin" id="loginBtn">Login</a>
                    <a href="register.php" class="btn btn-primary" id="signUpBtn">SignUp</a>
                <?php endif; ?>

                <!-- Cart Icon with Badge -->
                <a href="cart.php" class="btn btn-outline-primary cart-icon">
                    <i class="bx bx-cart"></i> <!-- Cart icon -->
                    <span class="badge"><?php echo $cartItemCount; ?></span> <!-- Cart item count -->
                </a>
            </div>

    </nav>
 <style>
    /* Navbar custom styling */
.navbar-custom {
    background-color: #F06292; /* Warna pink muda */
    color: white;
}

/* Navbar Brand */
.navbar-custom .navbar-brand {
    color: white;
    font-weight: bold;
}

/* Navbar Button - Outline */
.navbar-custom .btn-outline-primary {
    border-color: #ffffff; /* Warna border putih */
    color: #ffffff; /* Warna teks putih */
}

/* Hover effect for outlined button */
.navbar-custom .btn-outline-primary:hover {
    background-color: #ffffff; /* Warna latar belakang putih saat hover */
    color: #F06292; /* Teks menjadi pink muda saat hover */
}

/* Button utama Daftar */
.navbar-custom .btn-primary {
    background-color: #ffffff; /* Warna tombol putih */
    color: #F06292; /* Teks pink muda */
    border-color: #ffffff;
}

/* Hover effect for primary button */
.navbar-custom .btn-primary:hover {
    background-color: #F06292; /* Warna latar belakang pink muda saat hover */
    color: #ffffff; /* Teks menjadi putih saat hover */
}

/* Styling untuk container tombol */
.d-flex {
    display: flex;
    gap: 1rem;
    align-items: center;
    justify-content: flex-end; /* Tombol menempel di sisi kanan */
}

/* Optional: Jika ingin border-radius pada tombol */
.navbar-custom .btn {
    border-radius: 30px; /* Membuat tombol lebih melengkung */
}

/* Custom Margin untuk tombol agar memberi jarak antara tombol */
.custom-margin {
    margin-right: 10px;
}
/* Custom Icon User */
#profileIcon {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    border-radius: 50%;
    padding: 0.5rem;
    color: #ffffff;
    background-color: #F06292;
}

#profileIcon:hover {
    background-color: #ffffff;
    color: #F06292;
}

</style>
</header>
