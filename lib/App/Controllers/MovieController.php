<?php

namespace App\Controllers;

class MovieController
{
    public function index($f3)
    {
        $f3->set('title', 'Movies');

        $layoutUrl = 'https://lgi-new-api.aws.playco.com/api/v1.2/layout/home/9c797f3612974809a6c1384575800add-lgi?origin=web-chrome&x-geo-country=IN&profileType=EV&version=2&modules=0-100';
        $moduleUrl = 'https://lgi-new-api.aws.playco.com/api/v1.2/modules/home/9c797f3612974809a6c1384575800add-lgi?origin=web-chrome&x-geo-country=IN&profileType=EV&version=2&modules=0-100';

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
            "x-token: SGVyb3xUb3AgMTAgaW4gSW5kaWF8TXVzdCBXYXRjaCBOb3d8UGF0cmlvdGljIFB1bmNofEN1cmF0ZWQgZm9yIFlvdXxDb21pbmcgU29vbiBvbiBMaW9uc2dhdGUgUGxheXxXYXRjaCBOZXh0fEtvcmVhbiBEaWFyaWVzfFRoaXMgV2VlaydzIFJlY29tbWVuZGF0aW9uc3xUb3AgMTAgTW92aWVzIGluIEluZGlhfEhpZ2ggT2N0YW5lIEhpdHN8Rmlyc3QgRXBpc29kZSBGcmVlfEJpZyBHdW5zIG9mIEhvbGx5d29vZHxQb3dlciBQYWNrZWR8SGFzIEZhbGxlbiBGcmFuY2hpc2V8SG9sbHl3b29kIEJsb2NrYnVzdGVyIEZyYW5jaGlzZXxIb3VzZSBPZiBIb3Jyb3J8VG9wIDEwIFNlcmllcyBpbiBJbmRpYXxDcmVhdHVyZSBDaHJvbmljbGVzfFN0YXIgU3R1ZGRlZHxEdWJiZWQgZm9yIFlvdXxXb21lbiBJbiBBY3Rpb258U3RlYW15ICYgU2VkdWN0aXZlfERyYW1hIEZldmVyfFNwb3J0c2ZsaXh8VGhyaWxsZXJ8TGlvbnNnYXRlIFBsYXkgU2VsZWN0aW9ufE1vdmllcyBvZiBJbmRpYXw="
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
            $cta = $layoutModule['cta'] ?? null; // <- Check if this exists



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
// ✅ Extract all images (jpg, png, etc.)
                        $allImages = [];

                        if (isset($movie['images']) && is_array($movie['images'])) {
                            foreach ($movie['images'] as $img) {
                                if (isset($img['url'])) {
                                    $url = $img['url'];

                                    // Only include if it's an image with a common extension
                                    if (preg_match('/\.(jpg|jpeg|png|webp)$/i', $url)) {
                                        $type = $img['type'] ?? 'unknown';
                                        $allImages[$type] = $url;
                                    }
                                }
                            }
                        }

                        $movie['allImages'] = $allImages;  // Store all images by type (like DMHE, Tile, etc.)
//                        $movie['imageUrl'] = $image;

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
                    'cta' => $cta, // <-- pass to template
                ];
            }
        }

        // Sort carousels by layoutOrder
        usort($carousels, function ($a, $b) {
            return $a['layoutOrder'] <=> $b['layoutOrder'];
        });

        $f3->set('carousels', $carousels);

//        echo '<pre>';
//        print_r($layoutModules);
//        exit;
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