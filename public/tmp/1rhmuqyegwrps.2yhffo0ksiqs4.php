<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= ($title ?: 'Entertainment Site') ?></title>
    <link rel="stylesheet" href="ui/headerStyles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<header class="main-header">
    <!-- Mobile hamburger + logo + search -->
    <div class="mobile-header">
        <div class="hamburger" id="hamburger">&#9776;</div>
        <div class="logo mobile-logo">
            <img src="/images/lgiLogo.png" alt="Logo" />
        </div>
        <button class="search-icon">&#128269;</button>
    </div>

    <!-- Desktop header layout -->
    <div class="desktop-header desktop-only">
        <div class="left-section">
            <div class="logo">
                <img src="/images/lgiLogo.png" alt="Logo" />
            </div>
            <nav class="main-nav">
                <ul class="nav-list">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">TV Shows</a></li>
                    <li><a href="#">Movies</a></li>
                </ul>
            </nav>
        </div>

        <div class="header-actions">
            <button class="search-icon">&#128269;</button>
            <a href="#" class="login">Login</a>
            <a href="#" class="signup">Sign Up</a>
        </div>
    </div>

    <!-- Mobile dropdown menu -->
    <div class="mobile-menu" id="mobileMenu">
        <ul>
            <li class="auth-mobile">
                <a href="#" class="LoginMobile">Login</a>
                <a href="#" class="signupMobile">Sign Up</a>
            </li>
            <li><a href="#">Home</a></li>
            <li><a href="#">TV Shows</a></li>
            <li><a href="#">Movies</a></li>
        </ul>
    </div>
</header>

<script>
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');

    hamburger.addEventListener('click', () => {
        mobileMenu.classList.toggle('show');
    });
</script>

</body>
</html>
