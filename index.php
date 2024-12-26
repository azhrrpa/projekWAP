<!doctype html>
<html lang="en">

<head>
    <?php session_start(); ?>
    <?php include('header.php'); ?>
    <?php include('navbar.php'); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
</head>

<body>
    <?php include('carousel.php'); ?>
    

    <main role="main" class="container mt-5">
    <section class="welcome-section text-center mb-5">
        <h2>Solusi Kesehatan Terlengkap</h2>
        <p>Selamat datang di Ties Pharmacy App! Temukan obat, vitamin, dan produk kesehatan lainnya dengan mudah.</p>
        <p><strong>Kesehatan Anda, prioritas kami.</strong></p>
    </section>

        <h2 class="mb-4">Artikel Terbaru</h2>

        <div class="row">
            <!-- Artikel 1 -->
            <div class="col-md-6">
                <div class="article-card position-relative">
                    <img src="img/buah-naga.jpg" alt="Buah Naga">
                    <div class="article-content">
                        <h5>Bolehkah Bayi 6 Bulan Makan Buah Naga? Ini Jawabannya</h5>
                        <p>Bolehkah bayi 6 bulan makan buah naga? Mungkin ada ibu yang belum tahu, nih. Soalnya...</p>
                        <a href="https://www.alodokter.com/bolehkah-bayi-6-bulan-makan-buah-naga-ini-jawabannya">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Artikel 2 -->
            <div class="col-md-6">
                <div class="article-card position-relative">
                    <img src="img/sukun.jpg" alt="Sukun">
                    <div class="article-content">
                        <h5>Sukun untuk Ibu Hamil, Ketahui Manfaat dan Cara Aman Mengonsumsinya</h5>
                        <p>Sukun untuk ibu hamil boleh Bumil konsumsi sejak trimester pertama, lho. Alasannya...</p>
                        <a href="https://www.alodokter.com/sukun-untuk-ibu-hamil-ketahui-manfaat-dan-cara-aman-mengonsumsinya">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Artikel 3 -->
            <div class="col-md-6">
                <div class="article-card position-relative">
                    <img src="img/bullying.jpg" alt="Bullying Verbal">
                    <div class="article-content">
                        <h5>Bullying Verbal, Ini Contoh dan Cara Menghadapinya</h5>
                        <p>Bullying verbal adalah segala bentuk perundungan yang terjadi melalui kata-kata...</p>
                        <a href="https://www.alodokter.com/bullying-verbal-ini-contoh-dan-cara-menghadapinya">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Artikel 4 -->
            <div class="col-md-6">
                <div class="article-card position-relative">
                    <img src="img/buah.png" alt="makanan dan buah">
                    <div class="article-content">
                        <h5>7 Makanan dan Buah untuk Asam Lambung yang Efektif Atasi Keluhan</h5>
                        <p>Makanan dan buah untuk asam lambung dapat menjadi salah satu pilihan untuk mengatasi keluhan yang...</p>
                        <a href="https://www.alodokter.com/makanan-dan-bufah-untuk-asam-lambung">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Artikel 5 -->
            <div class="col-md-6">
                <div class="article-card position-relative">
                    <img src="img/batuk2.png" alt="flu dan batuk">
                    <div class="article-content">
                        <h5>11 Obat Flu dan Batuk Dewasa yang Paling Ampuh Redakan Gejala</h5>
                        <p>Obat flu dan batuk dewasa bermanfaat untuk mengatasi berbagai gejala flu, seperti demam sampai batuk...</p>
                        <a href="https://www.alodokter.com/obat-flu-dan-batuk-dewasa-yang-paling-ampuh-redakan-gejala">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>

            <!-- Artikel 6 -->
            <div class="col-md-6">
                <div class="article-card position-relative">
                    <img src="img/olahraga2.png" alt="ide olahraga">
                    <div class="article-content">
                        <h5>10 Ide Olahraga di Rumah Tanpa Peralatan yang Mudah Dilakukan</h5>
                        <p>Olahraga di rumah tanpa peralatan, seperti yoga, push up, sit up, atau menari, tidak kalah...</p>
                        <a href="https://www.alodokter.com/10-ide-olahraga-di-rumah-tanpa-peralatan-yang-mudah-dilakukan">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include('kategori.php'); ?>
    <?php include('footer.php'); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<style>
        .article-card {
            display: flex;
            margin-bottom: 20px;
        }

        .article-card img {
            width: 180px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }

        .article-content {
            margin-left: 15px;
        }

        .article-content h5 {
            font-size: 18px;
            font-weight: bold;
        }

        .article-content p {
            font-size: 14px;
            color: #555;
        }

        .article-content a {
            color: #007bff;
            font-size: 14px;
        }

        .article-content a:hover {
            text-decoration: underline;
        }

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
</style>