<?php

namespace tmyers273\IceScraper\Http\Curl;

use tmyers273\IceScraper\ScraperResponse;

class CurlClient {

    public function get($url) : ScraperResponse
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        $response = new ScraperResponse($result);
        return $response;
    }

}