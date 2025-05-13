<?php

namespace App\Controllers;

class AboutController
{
    function index($f3) {
        $f3->set('title', 'About Us Meta Here');
        $f3->set('content', \Template::instance()->render('ui/about.html'));
        echo \Template::instance()->render('ui/layout.html');
    }
}