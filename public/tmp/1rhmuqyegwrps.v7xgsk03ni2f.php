<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<header>
    <?php echo $this->render('ui/header.html',NULL,get_defined_vars(),0); ?>
</header>
<body>

<h2>🔥 Popular Movies</h2>
<div style="display: flex; overflow-x: auto; gap: 16px; padding: 10px;">
    <?php foreach (($popular?:[]) as $movie): ?>
        <div style="min-width: 200px;">
            <img src="<?= ($movie['image']['medium']) ?>" style="width: 100%" />
            <h4><?= ($movie['name']) ?></h4>
        </div>
    <?php endforeach; ?>
</div>

<h2>🎭 Drama Movies</h2>
<div style="display: flex; overflow-x: auto; gap: 16px; padding: 10px;">
    <?php foreach (($drama?:[]) as $movie): ?>
        <div style="min-width: 200px;">
            <img src="<?= ($movie['image']['medium']) ?>" style="width: 100%" />
            <h4><?= ($movie['name']) ?></h4>
        </div>
    <?php endforeach; ?>
</div>

<h2>😂 Comedy Movies</h2>
<div style="display: flex; overflow-x: auto; gap: 16px; padding: 10px;">
    <?php foreach (($comedy?:[]) as $movie): ?>
        <div style="min-width: 200px;">
            <img src="<?= ($movie['image']['medium']) ?>" style="width: 100%" />
            <h4><?= ($movie['name']) ?></h4>
        </div>
    <?php endforeach; ?>
</div>
</body>
<footer>
    <?php echo $this->render('ui/footer.html',NULL,get_defined_vars(),0); ?>
</footer>
</html>