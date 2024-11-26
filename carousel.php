<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carousel Example</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        .carousel {
            margin-top: 30px;
        }
        
        body {
            padding-top: 50px; /* Jika header fixed */
        }
        .carousel-item img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
        }

        .carousel-item {
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 500px;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
        }

        .carousel-indicators [data-bs-target] {
            background-color: #007bff;
        }

        .carousel-inner {
            border-radius: 20px;
            overflow: hidden;
            max-width: 1500px;
            margin: auto;
        }
    </style>
</head>
<body>

    <!-- Carousel Section -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <?php
        // Daftar gambar carousel
        $slides = [
            ["src" => "img/BannerHome1.jpg", "alt" => "Slide 1"],
            ["src" => "img/BannerHomepage2.jpg", "alt" => "Slide 2"],
            ["src" => "img/BannerHomepage3.jpg", "alt" => "Slide 3"]
        ];
        ?>

        <!-- Indicators -->
        <div class="carousel-indicators">
            <?php foreach ($slides as $index => $slide): ?>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>"></button>
            <?php endforeach; ?>    
        </div>

        <!-- Inner Content -->
        <div class="carousel-inner">
            <?php foreach ($slides as $index => $slide): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                    <?php if (file_exists($slide['src'])): ?>
                        <img src="<?= $slide['src'] ?>" class="d-block w-100" alt="<?= $slide['alt'] ?>">
                    <?php else: ?>
                        <div class="fallback-text"><?= $slide['alt'] ?>: Gambar tidak tersedia</div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
