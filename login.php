<?php
session_start(); 
include('database/connection.php');

// Jika pengguna sudah login, arahkan berdasarkan role
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: ManageProduct.php");
        exit();
    } elseif ($_SESSION['role'] === 'user') {
        header("Location: index.php");
        exit();
    }
}

// Proses login
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($password)) {
        $error = "Email atau password tidak boleh kosong!";
    } else {
        $query = "SELECT * FROM pengguna WHERE email = ?";
        $stmt = $db->connection->prepare($query);

        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Verifikasi password
                if (password_verify($password, $user['password'])) {
                    // Simpan data ke dalam session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];

                    // Redirect berdasarkan role
                    if ($user['role'] === 'admin') {
                        header("Location: ManageProduct.php");
                        exit();
                    } elseif ($user['role'] === 'user') {
                        header("Location: index.php");
                        exit();
                    } else {
                        $error = "Role tidak dikenali!";
                    }
                } else {
                    $error = "Password salah!";
                }
            } else {
                $error = "Email tidak ditemukan!";
            }

            $stmt->close();
        } else {
            $error = "Terjadi kesalahan saat memproses permintaan.";
        }
    }
}

// Debug: Menampilkan error jika ada
if (isset($error)) {
    echo "<p style='color: red;'>$error</p>";
}
?>



<!doctype html>
<html lang="en">
<head>
    <?php include('header.php') ?>
    <?php include('navbar.php') ?>
</head>

<body>

    <main role="main" class="container">
        <div class="container mt-5">
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="mb-4">Halaman Login</h5>

                    <!-- Tampilkan pesan error jika ada -->
                    <?php
                    if (isset($error)) {
                        echo '<div class="alert alert-danger">' . $error . '</div>';
                    }
                    ?>

                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Input your email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Input your password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="login" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include('footer.php') ?>
</body>
</html>
