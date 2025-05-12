<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

$f3 = \Base::instance();

$f3->route('GET /', function () {
    echo 'Hello from Fat-Free Framework!';
});

$f3->run();
