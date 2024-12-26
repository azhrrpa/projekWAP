<?php
session_start();
require 'database/connection.php'; // Sertakan file yang mendefinisikan koneksi database
include 'header.php';   

// Ambil ID pengguna dari sesi
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; // Sesuaikan sesuai kebutuhan

// Jika form dikirim, proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi dan hash password (jika tidak kosong)
    $password_hash = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : null;

    // Update database
    $sql_update = "UPDATE pengguna SET nama = ?, email = ?" . ($password_hash ? ", password = ?" : "") . " WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);

    if ($password_hash) {
        $stmt_update->bind_param("sssi", $nama, $email, $password_hash, $user_id);
    } else {
        $stmt_update->bind_param("ssi", $nama, $email, $user_id);
    }

    if ($stmt_update->execute()) {
        $message = "Profil berhasil diperbarui.";
    } else {
        $message = "Gagal memperbarui profil: " . $conn->error;
    }

    $stmt_update->close();
}

// Query data pengguna
$sql = "SELECT * FROM pengguna WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Pengguna tidak ditemukan.";
        exit;
    }

    $stmt->close();
} else {
    echo "Query gagal disiapkan: " . $conn->error;
    exit;
}

$db->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <body>
    <div class="profile-container">
        <h2>Profil Pengguna</h2>
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
        <div class="profile-item">
            <strong>Nama:</strong>
            <span><?php echo htmlspecialchars($user['nama']); ?></span>
        </div>
        <div class="profile-item">
            <strong>Email:</strong>
            <span><?php echo htmlspecialchars($user['email']); ?></span>
        </div>
        <div class="profile-item">
            <strong>Role:</strong>
            <span><?php echo htmlspecialchars($user['role']); ?></span>
        </div>
        <div class="action-button">
            <!-- Tambahkan tombol untuk membuka form edit -->
            <button id="edit-button">Edit Profil</button>
        </div>
        <!-- Form edit biodata, disembunyikan secara default -->
        <form id="edit-form" action="" method="POST" style="display: none;">
            <h3>Edit Biodata</h3>
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <label for="password">Password Baru:</label>
            <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
            <button type="submit">Simpan Perubahan</button>
        </form>
        <div class="back-button">
            <a href="index.php">Kembali ke Halaman Utama</a>
        </div>
    </div>

    <script>
        // Tampilkan form edit jika tombol "Edit Profil" diklik
        document.getElementById('edit-button').addEventListener('click', function() {
            const form = document.getElementById('edit-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });
    </script>

</body>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #ff9a9e, #fad0c4);
        padding: 0 20px;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .profile-container {
        max-width: 500px;
        width: 100%;
        background: #ffffff;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .profile-container:hover {
        transform: scale(1.02);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .profile-container h2 {
        text-align: center;
        font-size: 28px;
        color: #333;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .profile-item {
        margin-bottom: 20px;
    }

    .profile-item strong {
        display: block;
        font-size: 16px;
        color: #f06292;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .profile-item span {
        display: block;
        font-size: 18px;
        color: #555;
    }

    /* Tombol Aksi */
    .action-button, .back-button {
        text-align: center;
        margin-top: 20px;
    }

    .action-button button, .back-button a {
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 10px;
        display: inline-block;
        border: none;
    }

    .action-button button {
        background: #007bff;
    }

    .action-button button:hover {
        background: #0056b3;
    }

    .back-button a {
        background: #ff6f61;
    }

    .back-button a:hover {
        background: #e35b8f;
    }

    /* Form Edit Biodata */
    #edit-form {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #f9f9f9;
        display: none;
    }

    #edit-form h3 {
        margin-bottom: 15px;
        font-size: 22px;
        color: #444;
        text-align: center;
    }

    #edit-form label {
        display: block;
        font-size: 16px;
        color: #666;
        margin-bottom: 5px;
    }

    #edit-form input {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 15px;
        outline: none;
        transition: border-color 0.3s ease;
    }

    #edit-form input:focus {
        border-color: #007bff;
    }

    #edit-form button {
        width: 100%;
        padding: 12px;
        background: #28a745;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        color: white;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    #edit-form button:hover {
        background: #218838;
    }

    /* Responsif */
    @media (max-width: 480px) {
        .profile-container {
            padding: 20px;
        }
        .profile-container h2 {
            font-size: 22px;
        }
    }
</style>
</html>





