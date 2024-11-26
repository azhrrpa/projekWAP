<?php include('header.php'); ?>

<main role="main" class="container mt-5 pt-5">
    <!-- Teks pengantar di atas kategori produk -->
    <section class="welcome-section text-center mb-5">
        <h2>Solusi Kesehatan Terlengkap</h2>
        <p>Selamat datang di Ties Pharmacy App! Temukan obat, vitamin, dan produk kesehatan lainnya dengan mudah.</p>
        <p><strong>Kesehatan Anda, prioritas kami.</strong></p>
    </section>

    <!-- Kategori Produk -->
    <h2 class="text-left mb-5">Kategori Produk</h2>
    <div class="row">
        <!-- Kategori 1 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=vitamin">
                    <img src="img/vitamin-preview.png" alt="Kontrasepsi" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Vitamin</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 2 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=asma&pernafasan">
                    <img src="img/asma&nafas.png" alt="Asma & Pernapasan" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Asma & Pernapasan</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 3 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=alatkesehatan">
                    <img src="img/alat kesehatan.png" alt="Alat Kesehatan" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Alat Kesehatan</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 4 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=diabetes">
                    <img src="img/diabetes.png" alt="Suplemen" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Diabetes</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 5 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=jantung">
                    <img src="img/jantung.png" alt="Antiseptic" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Jantung</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 6 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=mata">
                    <img src="img/mata.png" alt="Flu Batuk Alergi" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Mata</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 7 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=kolesterol">
                    <img src="img/kolesterol.png" alt="Pereda Nyeri" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Kolesterol</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 8 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=lambung">
                    <img src="img/lambung.png" alt="Demam" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Lambung</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 9 (Pernafasan) -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=demam">
                    <img src="img/demam.png" alt="Pernafasan" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Demam</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 10 (Jantung) -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=diare">
                    <img src="img/diare.png" alt="Jantung" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Diare</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 11 (Susu) -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=menstruasi">
                    <img src="img/mens.png" alt="Susu" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Menstruasi</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 12 (Buah) -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                <a href="kategori-detail.php?kategori=susu">
                    <img src="img/susu.png" alt="Buah" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Susu</h5>
                </a>
            </div>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>

<!-- Menyertakan file JavaScript eksternal -->
<script src="js/cart.js"></script>

<style>
    /* Styling untuk bagian pengantar */
    .welcome-section {
        background-color: #f19cbb; /* Warna pink muda */
        padding: 30px;
        border-radius: 10px;
        color: white;
        text-align: center;
        margin-bottom: 30px; /* Jarak antara pengantar dan kategori */
    }

    .welcome-section h2 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .welcome-section p {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .welcome-section strong {
        font-size: 20px;
    }

    /* Styling untuk box kategori */
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
        box-shadow: 0 8px 15px rgba(255, 105, 180, 0.5);
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
</style>
