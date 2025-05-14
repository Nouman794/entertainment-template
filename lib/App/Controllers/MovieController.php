<?php

namespace App\Controllers;

class MovieController
{
    public function index($f3)
    {
        $f3->set('title', 'Movies');

        $layoutUrl = 'https://lgi-dev-new-api.aws.playco.com/api/v1.2/layout/home/9c797f3612974809a6c1384575800add-lgi?origin=web-chrome&x-geo-country=IN&profileType=EV&version=2&modules=0-100';
        $moduleUrl = 'https://lgi-dev-new-api.aws.playco.com/api/v1.2/modules/home/9c797f3612974809a6c1384575800add-lgi?origin=web-chrome&x-geo-country=IN&profileType=EV&version=2&modules=0-100';

        $Headers = [
            "Authorization: Bearer spx-v1.eyJpc3MiOiI5Yzc5N2YzNjEyOTc0ODA5YTZjMTM4NDU3NTgwMGFkZC1sZ2kiLCJlbnYiOiJsZ2ktZGV2IiwiaWF0IjoxNzQ1NDE1MDczfQ.tqaiS652LVWZG5UqD1G0RverTbS1yOvhOXFi0R2VSt0",
            "client-type: website",
            "Content-Type: application/json",
            "x-profiletype: EV",
            "x-geo-country: IN",
            "x-profile-id: 9c797f3612974809a6c1384575800add-lgi",
            "x-profile-category: adult",
            "x-user-id: 9c797f3612974809a6c1384575800add-lgi",
            "x-query: ZW58MTh8REVW",
            "x-token: SEVST3xUb3AgMjB8TGF5b3V0IG1pcnJvcmluZyB0ZXN0aW5nfExpb25zZ2F0ZSBCbG9ja2J1c3RlcnMgSGl0c3x0ZXN0IDF8bGlzdDVvcmd8"
        ];

        $layoutResponse = $this->curlGet($layoutUrl, $Headers);
        $layoutData = json_decode($layoutResponse, true);

        $moduleResponse = $this->curlGet($moduleUrl, $Headers);
        $moduleData = json_decode($moduleResponse, true);

        $movies = [];

        // Loop over modules
        foreach ($moduleData as $module) {
            if (isset($module['titles'])) {
                foreach ($module['titles'] as $title) {
                    // Optional: Check it's a movie (you could use tag, programType, or anything else)
                    $isMovie = false;

                    if (isset($title['tags'])) {
                        foreach ($title['tags'] as $tag) {
                            if (isset($tag['tagTitle']) && strpos($tag['tagTitle'], 'Movies') !== false) {
                                $isMovie = true;
                                break;
                            }
                        }
                    }

                    if ($isMovie) {
                        // Add permalink if not present
                        if (!isset($title['permalink']) && isset($title['title'])) {
                            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title['title'])));
                            $title['permalink'] = $slug;
                        }
                        $movies[] = $title;
                    }
                }
            }
        }

        // Pass to template
        $f3->set('movies', $movies);
        echo \Template::instance()->render('ui/movies.html');
    }
    private
    function curlGet($url, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
    }

}