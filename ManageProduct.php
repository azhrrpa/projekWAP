<?php
session_start();
include_once('database/connection.php');
include_once('database/pharmacy.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="container">
        <h1>Manage Products</h1>

        <!-- Add Product Form -->
        <form method="POST" enctype="multipart/form-data">
            <h2>Add Product</h2>
            <div class="form-group">
                <label for="nama_produk">Product Name</label>
                <input type="text" name="nama_produk" id="nama_produk" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Description</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="harga">Price</label>
                <input type="number" name="harga" id="harga" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="stok">Stock</label>
                <input type="number" name="stok" id="stok" required>
            </div>
            <div class="form-group">
                <label for="id_kategori">Category</label>
                <select name="id_kategori" id="id_kategori" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category['id'] ?>"><?= $category['nama_kategori'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="gambar">Image</label>
                <input type="file" name="gambar" id="gambar" accept="image/*">
            </div>
            <button type="submit" name="add_product" class="btn">Add Product</button>
        </form>

        <!-- Product List -->
        <h2>Product List</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) { ?>
                    <tr>
                        <td><?= htmlspecialchars($product['nama_produk']) ?></td>
                        <td><?= htmlspecialchars($product['deskripsi']) ?></td>
                        <td><?= htmlspecialchars($product['harga']) ?></td>
                        <td><?= htmlspecialchars($product['stok']) ?></td>
                        <td><?= htmlspecialchars($product['nama_kategori']) ?></td>
                        <td><img src="<?= htmlspecialchars($product['gambar']) ?>" alt="Product Image" style="width: 50px;"></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <button type="submit" name="edit_product_form" class="btn btn-edit">Edit</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <button type="submit" name="delete_product" class="btn btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Modal for Editing Product -->
        <?php if (isset($product_to_edit)) { ?>
            <div id="editProductModal" class="modal">
                <div class="modal-content">
                    <form method="POST" enctype="multipart/form-data">
                        <h2>Edit Product</h2>
                        <input type="hidden" name="id" value="<?= $product_to_edit['id'] ?>">
                        <div class="form-group">
                            <label for="nama_produk">Product Name</label>
                            <input type="text" name="nama_produk" id="nama_produk" value="<?= htmlspecialchars($product_to_edit['nama_produk']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Description</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" required><?= htmlspecialchars($product_to_edit['deskripsi']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="harga">Price</label>
                            <input type="number" name="harga" id="harga" step="0.01" value="<?= htmlspecialchars($product_to_edit['harga']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stock</label>
                            <input type="number" name="stok" id="stok" value="<?= htmlspecialchars($product_to_edit['stok']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="id_kategori">Category</label>
                            <select name="id_kategori" id="id_kategori" required>
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?= $category['id'] ?>" <?= $category['id'] == $product_to_edit['id_kategori'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['nama_kategori']) ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Image</label>
                            <input type="file" name="gambar" id="gambar" accept="img/*">
                            <small>Current: <?= htmlspecialchars($product_to_edit['gambar']) ?></small>
                        </div>
                        <button type="submit" name="edit_product" class="btn">Save Changes</button>
                    </form>
                </div>
            </div>
        <?php } ?>

        <!-- Logout Button -->
        <form method="POST">
            <button type="submit" name="logout" class="logout-button">Logout</button>
        </form>
    </div>
</body>
</html>

<style>
.modal {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 1000;
}

.modal-content {
    background-color: #fff;
    padding: 25px;
    border-radius: 10px;
    width: 40%;
    max-width: 600px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
}

.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

h1 {
    color: #444;
    text-align: center;
    margin-bottom: 20px;
    font-size: 2.5em;
}

h2 {
    color: #555;
    margin-top: 30px;
    font-size: 1.8em;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 1em;
    background-color: #fff;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 15px;
    text-align: left;
}

th {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #f5f5f5;
}

/* Form Styling */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-weight: bold;
    margin-bottom: 8px;
    display: block;
    color: #333;
}

.form-group input, .form-group select, .form-group textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1em;
    box-sizing: border-box;
}

textarea {
    resize: none;
}

/* Button Styling */
.btn {
    padding: 10px 20px;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1em;
}

.btn:hover {
    background-color: #0056b3;
}

.btn-edit {
    background-color: #ffc107;
}

.btn-delete {
    background-color: #dc3545;
}

.btn-edit:hover {
    background-color: #e0a800;
}

.btn-delete:hover {
    background-color: #bd2130;
}

.btn-container {
    display: flex;
    justify-content: start;
    gap: 10px;
}

/* Logout Button Styling */
.logout-button {
    background-color: #007bff;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-size: 1em;
    cursor: pointer;
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 1000;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s ease;
}

.logout-button:hover {
    background-color: #0056b3;
}
</style>
