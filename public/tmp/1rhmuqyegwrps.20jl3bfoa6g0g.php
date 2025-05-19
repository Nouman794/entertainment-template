<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= ($title) ?></title>
    <link rel="stylesheet" href="ui/movieStyles.css">
</head>
<body>

<header>
    <?php echo $this->render('ui/header.html',NULL,get_defined_vars(),0); ?>
</header>

<?php if ($carousels): ?>
    <div class="carousel-container">
        <?php foreach (($carousels?:[]) as $carousel): ?>
            <div class="carousel-wrapper carousel-wrapper-layout-<?= ($carousel['category']) ?>">
                <?php if ($carousel['title'] != 'Hero'): ?>
                    <h2 class="carousel-title"><?= ($carousel['title']) ?></h2>
                <?php endif; ?>

                <button class="carousel-btn prev-btn">&#10094;</button>
                <div class="carousel">
                    <?php foreach (($carousel['items']?:[]) as $movie): ?>
                        <div class="movie-card">
                            <img src="<?= ($movie['allImages']['DMHE'] ?: array_values($movie['allImages'])[0]) ?>" alt="<?= ($movie['title']) ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-btn next-btn">&#10095;</button>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<footer>
    <?php echo $this->render('ui/footer.html',NULL,get_defined_vars(),0); ?>
</footer>

<script src="ui/movieScript.js"></script>
</body>
</html>
