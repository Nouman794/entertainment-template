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
                <?php foreach (($carousel['items']?:[]) as $item): ?>
                    <div class="carousel-item">
                        <img src="<?= ($item['imageUrl'] ?: 'https://via.placeholder.com/200x300?text=No+Image') ?>" alt="<?= ($item['title']) ?>">
                        <p><?= ($item['title']) ?></p>
                    </div>
                <?php endforeach; ?>
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
