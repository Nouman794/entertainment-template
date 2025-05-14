<?php

$f3 = \Base::instance();

// Home route
$f3->route('GET /', '\App\Controllers\HomeController->index');

// Movies page
$f3->route('GET /movies', '\App\Controllers\MovieController->index');

//$f3->route('GET /movies', 'controllers\MovieController->showMovies');


// About page
$f3->route('GET /about', '\App\Controllers\AboutController->index');