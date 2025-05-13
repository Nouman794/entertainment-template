<?php

namespace App\Controllers;


class HomeController
{
    function index($f3) {
        $f3->set('title', 'Home Meta Here');
        $f3->set('content', \Template::instance()->render('ui/home.html'));
        echo \Template::instance()->render('ui/layout.html');
    }

}
