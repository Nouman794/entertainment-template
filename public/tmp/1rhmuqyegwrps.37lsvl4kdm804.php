<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<!--    if .html file don't have @title this default title will show-->
    <title><?= ($title ?: 'Entertainment Site') ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        nav, footer { background-color: #222; color: white; padding: 10px 20px; }
        nav a, footer a { color: white; text-decoration: none; margin-right: 15px; }
        footer { text-align: center; font-size: 14px; }
        .content { padding: 20px; }
        .social-icons a { margin: 0 10px; }
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

<!--<main>-->
<!--    <?= ($this->raw($content)) ?>-->
<!--</main>-->

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
