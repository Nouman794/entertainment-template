<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movies</title>
    <link rel="stylesheet" href="/ui/movieStyle.css">
</head>
<header>
    <?php echo $this->render('/ui/header.html',NULL,get_defined_vars(),0); ?>
</header>
<body>

<h2>🎬 All Movies</h2>
<div class="carousel-container">
    <div class="carousel">
        <?php foreach (($allMovies?:[]) as $movie): ?>
            <div class="carousel-item">
                <img src="<?= ($movie['image']['medium']) ?>" />
                <h4><?= ($movie['name']) ?></h4>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="carousel-arrow left-arrow">&#10094;</div>
    <div class="carousel-arrow right-arrow">&#10095;</div>
</div>

<h2>🎬 Few Movies</h2>
<div style="display: flex; overflow-x: auto; gap: 16px; padding: 10px;">
    <?php foreach (($movies?:[]) as $movie): ?>
        <div style="min-width: 200px;">
            <img src="<?= ($movie['image']['medium']) ?>" style="width: 100%" />
            <h4><?= ($movie['name']) ?></h4>
        </div>
    <?php endforeach; ?>
</div>
<script src="/ui/movieScripts.js"></script>
</body>
<footer>
    <?php echo $this->render('ui/footer.html',NULL,get_defined_vars(),0); ?>
</footer>
</html>
