<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Movies</title>
    <link rel="stylesheet" href="ui/movieStyles.css">
</head>
<header>
    <?php echo $this->render('ui/header.html',NULL,get_defined_vars(),0); ?>
</header>
<body>

<h2>🎬 Carousal Movies</h2>
<div class="carousel-container">
    <div class="carousel">
        <?php foreach (($movies?:[]) as $movie): ?>
            <div class="carousel-item">
                <a href="/movies/<?= ($movie['permalink']) ?>/<?= ($movie['id']) ?>">
                    <img src="<?= ($movie['images'][0]['url']) ?>" alt="<?= ($movie['title']) ?>">
<!--                    <p><?= ($movie['title']) ?></p>-->
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Arrows -->
    <button class="arrow left">&#10094;</button>
    <button class="arrow right">&#10095;</button>
</div>

<h2>🎬 All Movies</h2>
<!--<div class="movies-grid">-->
<!--    <?php foreach (($movies?:[]) as $movie): ?>-->
<!--        <li>-->
<!--            <a href="/movies/<?= (isset($movie['permalink']) ? $movie['permalink'] : 'unknown') ?>/<?= ($movie['id']) ?>">-->
<!--                <strong><?= ($movie['title']) ?></strong><br>-->
<!--                <?php if (isset($movie['images'][0]['url'])): ?>-->
<!--                    <img src="<?= ($movie['images'][0]['url']) ?>" style="width:200px;">-->
<!--                <?php endif; ?>-->
<!--            </a>-->
<!--        </li>-->
<!--    <?php endforeach; ?>-->
<!--</div>-->

<h2>🎬 Few Movies</h2>
<div style="display: flex; overflow-x: auto; gap: 16px; padding: 10px;">
    <?php foreach (($movies?:[]) as $movie): ?>
        <div style="min-width: 200px;">
            <img src="<?= ($movie['image']['medium']) ?>" style="width: 100%" />
            <h4><?= ($movie['name']) ?></h4>
        </div>
    <?php endforeach; ?>
</div>
<script src="ui/movieScript.js"></script>
</body>
<footer>
    <?php echo $this->render('ui/footer.html',NULL,get_defined_vars(),0); ?>
</footer>
</html>
