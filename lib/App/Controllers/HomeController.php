<?php

namespace App\Controllers;


class HomeController
{
    function index($f3) {
        // Get all shows from API
        $f3->set('title', 'Home Page Meta Here');
        $apiUrl = 'https://api.tvmaze.com/shows';
        $json = file_get_contents($apiUrl);
        $shows = json_decode($json, true);

        // Limit total shows for performance
        $shows = array_slice($shows, 0, 60);

        // Create 3 groups (simulate genres)
        $f3->set('popular', array_slice($shows, 0, 20));
        $f3->set('drama', array_slice($shows, 20, 20));
        $f3->set('comedy', array_slice($shows, 40, 20));

        // Render the view
        echo \Template::instance()->render('ui/home.html');
    }

}
