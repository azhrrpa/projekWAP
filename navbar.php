<header>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Ties Pharmacy App</a>


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
                    <!-- Jika pengguna belum login, tampilkan tombol Login dan SignUp -->
                    <a href="login.php" class="btn btn-outline-primary custom-margin" id="loginBtn">Login</a>
                    <a href="register.php" class="btn btn-primary" id="signUpBtn">SignUp</a>
                <?php endif; ?>

                <!-- Cart Icon with Badge -->
                <a href="cart.php" class="btn btn-outline-primary cart-icon">
                    <i class="bx bx-cart"></i> <!-- Cart icon -->
                </a>
            </div>

        </div>
    </nav>
</header>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Cek apakah tombol login dan signup disembunyikan sebelumnya
            if (localStorage.getItem("formSubmitted") === "true") {
                const loginButton = document.getElementById("loginBtn");
                const signUpButton = document.getElementById("signUpBtn");
                
                
                if (loginButton && signUpButton) {
                    loginButton.style.display = "none";
                    signUpButton.style.display = "none";
                }
            }

            // Cek jika form register disubmit
            const form = document.getElementById('registerForm');
            form.addEventListener('submit', function () {
                localStorage.setItem("formSubmitted", "true");  // Menyimpan status form telah disubmit
            });
        });
</script>

<style>
    .navbar-custom {
        background-color: #F06292; 
        color: white;
    }
    .navbar-custom .navbar-brand {
        color: white;
        font-weight: bold;
    }
    .navbar-custom .btn-outline-primary {
        border-color: #ffffff; 
        color: #ffffff; 
    }
    .navbar-custom .btn-outline-primary:hover {
        background-color: #ffffff; 
        color: #F06292; 
    }
    .navbar-custom .btn-primary {
        background-color: #ffffff; 
        color: #F06292; 
        border-color: #ffffff;
    }
    .navbar-custom .btn-primary:hover {
        background-color: #F06292;
        color: #ffffff; 
    }
    .d-flex {
        display: flex;
        gap: 1rem;
        align-items: center;
        justify-content: flex-end;
    }
    .navbar-custom .btn {
        border-radius: 30px; 
    }
    .custom-margin {
        margin-right: 10px;
    }
    main.container {
        padding-top: 100px;
    }
    .btn-primary {
        background-color: #F06292; 
        border-color: #F06292; 
        color: #ffffff; 
    }
    .btn-primary:hover {
        background-color: #D81B60; 
        border-color: #D81B60;
        color: #ffffff;
    }
</style>


