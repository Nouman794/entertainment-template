<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<!--    if .html file don't have @title this default title will show-->
    <title><?= ($title ?: 'Entertainment Site') ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        nav { background-color: #222; color: white; padding: 10px 20px; }
        nav a { color: white; text-decoration: none; margin-right: 15px; }
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
</body>
</html>
