<!doctype html>
<html lang="en">

<?php session_start(); ?>
<?php include('controller/middleware.php'); ?>

<head>
    <?php include('carousel.php') ?>
    <?php include('header.php') ?>
    <?php include('category.php') ?>
     
</head>

<body>
    <?php include('navbar.php') ?>


    <main role="main " class="container">
        <?php 
            include('database/pharmacy.php');

            $data = new Pharmacy();
        ?>

<h2 class="text-left mb-5">Produk Terlaris</h2>
    <div class="row">
        <!-- Kategori 1 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                    <img src="img/sanmol.jpeg" alt="Kontrasepsi" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Sanmol</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 2 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                    <img src="img/tolakangin.jpg" alt="Asma & Pernapasan" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Tolak Angin</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 3 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                    <img src="img/imboost.png" alt="Alat Kesehatan" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Imboost</h5>
                </a>
            </div>
        </div>
        <!-- Kategori 4 -->
        <div class="col-12 col-md-3 text-center mb-4">
            <div class="category-box">
                    <img src="img/diapet.jpg" alt="Suplemen" class="img-fluid mb-3" style="width: 150px; height: 150px;">
                    <h5>Diapet</h5>
                </a>
            </div>
        </div>

    
    <?php include_once('scripts.php') ?>
    <?php include_once('footer.php') ?>
</body>

</html>