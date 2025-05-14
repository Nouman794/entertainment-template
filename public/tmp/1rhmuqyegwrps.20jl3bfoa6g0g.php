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

<h2>🎬 Carousel Movies</h2>

<?php if ($carousels): ?>
    <div class="carousel-container">
        <div class="carousel">
            <?php foreach (($carousels?:[]) as $carousel): ?>
                <h2><?= ($carousel['title']) ?></h2>

                <div class="carousel">
                    <?php foreach (($carousel['items']?:[]) as $movie): ?>
                        <div class="movie-card">
                            <?php foreach (($movie['allImages']?:[]) as $type=>$url): ?>
                                <p><strong><?= ($type) ?>:</strong></p>
                                <img src="<?= ($url) ?>" alt="<?= ($movie['title']) ?> - <?= ($type) ?>">
                            <?php endforeach; ?>
                            <p><?= ($movie['title']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <button class="arrow left">&#10094;</button>
        <button class="arrow right">&#10095;</button>
    </div>
<?php endif; ?>

<footer>
    <?php echo $this->render('ui/footer.html',NULL,get_defined_vars(),0); ?>
</footer>

<script src="ui/movieScript.js"></script>
</body>
</html>
