<?php

namespace App\Controllers;

class MovieController
{
    public function index($f3)
    {
        $f3->set('title', 'Movies Page Meta Here');
        // Fetch API Data
        $apiUrl = 'https://api.tvmaze.com/shows';
        $json = file_get_contents($apiUrl);
        $movies = json_decode($json, true);

        // You can limit the results if needed
        $f3->set('movies', array_slice($movies, 15, 30)); // Just 15 for now

        $response = file_get_contents('https://api.tvmaze.com/shows'); // API Call
        $allMovies = json_decode($response, true);
        $f3->set('allMovies', $allMovies);

        // Render the template
        echo \Template::instance()->render('ui/movies.html');
    }

 }