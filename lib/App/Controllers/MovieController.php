<?php

namespace App\Controllers;

class MovieController
{
    public function index($f3)
    {
        $f3->set('title', 'Movies');

        $layoutUrl = 'https://lgi-dev-new-api.aws.playco.com/api/v1.2/layout/home/9c797f3612974809a6c1384575800add-lgi?origin=web-chrome&x-geo-country=IN&profileType=EV&version=2&modules=0-100';
        $moduleUrl = 'https://lgi-dev-new-api.aws.playco.com/api/v1.2/modules/home/9c797f3612974809a6c1384575800add-lgi?origin=web-chrome&x-geo-country=IN&profileType=EV&version=2&modules=0-100';

        $headers = [
            "Authorization: Bearer spx-v1...",
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

        $layoutData = json_decode($this->curlGet($layoutUrl, $headers), true);
        $moduleData = json_decode($this->curlGet($moduleUrl, $headers), true);

        $layoutModules = $layoutData['modules'] ?? [];
        $moduleMap = [];

        // Build a map of module ID => moduleData for fast lookup
        foreach ($moduleData as $mod) {
            if (isset($mod['id'])) {
                $moduleMap[$mod['id']] = $mod;
            }
        }

        $carousels = [];

        // Go through layoutModules and find matching data from module API
        foreach ($layoutModules as $layoutModule) {
            $id = $layoutModule['id'];
            $title = $layoutModule['title'] ?? '';
            $layoutOrder = $layoutModule['layoutOrder'] ?? 0;
            $type = $layoutModule['type'] ?? '';
            $category = $layoutModule['category'] ?? '';

            $items = [];

            if (isset($moduleMap[$id]) && isset($moduleMap[$id]['titles'])) {
                foreach ($moduleMap[$id]['titles'] as $movie) {
                    $isMovie = false;

                    if (isset($movie['tags'])) {
                        foreach ($movie['tags'] as $tag) {
                            if (isset($tag['tagTitle']) && strpos($tag['tagTitle'], 'Movies') !== false) {
                                $isMovie = true;
                                break;
                            }
                        }
                    }

                    if ($isMovie) {
                        // Ensure permalink exists
                        if (!isset($movie['permalink']) && isset($movie['title'])) {
                            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $movie['title'])));
                            $movie['permalink'] = $slug;
                        }

                        $items[] = $movie;
                    }
                }
            }

            if (!empty($items)) {
                $carousels[] = [
                    'title' => $title,
                    'layoutOrder' => $layoutOrder,
                    'type' => $type,
                    'category' => $category,
                    'items' => $items,
                ];
            }
        }

        // Sort carousels by layoutOrder
        usort($carousels, function ($a, $b) {
            return $a['layoutOrder'] <=> $b['layoutOrder'];
        });

        $f3->set('carousels', $carousels);


        echo \Template::instance()->render('ui/movies.html');
    }

    private function curlGet($url, $headers)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}