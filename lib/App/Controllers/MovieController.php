<?php

namespace App\Controllers;

class MovieController
{
    function index($f3) {
        $f3->set('title', 'Movies Meta Here');
        $f3->set('content', \Template::instance()->render('ui/movies.html'));
        echo \Template::instance()->render('ui/layout.html');
    }

 }