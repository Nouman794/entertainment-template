<?php
// Show all errors while developing
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Composer autoload (make sure this path is correct)
require_once __DIR__ . '/../vendor/autoload.php';

// Create the F3 instance
$f3 = \Base::instance();

//// Load the routes
require_once __DIR__ . '/../routes/webroutes.php';
//require_once('../webroutes.php');

// Run the application
$f3->run();
