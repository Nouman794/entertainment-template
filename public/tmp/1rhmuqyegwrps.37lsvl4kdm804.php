<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<!--    if .html file don't have @title this default title will show-->
    <title><?= ($title ?: 'Entertainment Site') ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        header, footer { background: #333; color: #fff; padding: 15px; text-align: center; }
        nav a { margin: 0 15px; color: white; text-decoration: none; }
        main { padding: 20px; }
        footer a { color: white; margin: 0 5px; }
    </style>
</head>
<body>
<header>
    <h1>Entertainment</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/movies">Movies</a>
        <a href="/about">About</a>
    </nav>
</header>

<main>
    <?= ($this->raw($content))."
" ?>
</main>

<footer>
    <p>&copy; Domain.com All rights reserved.</p>
    <p>
        <a href="https://facebook.com" target="_blank">Facebook</a> |
        <a href="https://twitter.com" target="_blank">Twitter</a> |
        <a href="https://instagram.com" target="_blank">Instagram</a>
    </p>
</footer>
</body>
</html>
