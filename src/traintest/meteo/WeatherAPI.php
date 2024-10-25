<?php

namespace App\traintest\meteo;

class WeatherAPI {
    private $apiKey;
    private $baseUrl;

    public function __construct($apiKey) {
        $this->apiKey = $apiKey;
        $this->baseUrl = 'https://api.openweathermap.org/data/2.5/weather';
    }

    public function fetchForecast($location) {
        $url = sprintf('%s?q=%s&appid=%s', $this->baseUrl, urlencode($location), $this->apiKey);

        // Simule un appel à l'API (en vrai, tu utiliserais un client HTTP)
        $response = file_get_contents($url);

        if ($response === false) {
            throw new \Exception('API call failed');
        }

        $data = json_decode($response, true);

        if (isset($data['main'])) {
            return [
                'temperature' => $data['main']['temp'],
                'description' => $data['weather'][0]['description'],
            ];
        }

        throw new \Exception('Invalid API response');
    }
}
