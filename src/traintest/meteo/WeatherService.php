<?php

namespace App\traintest\meteo;

class WeatherService {
    private $weatherAPI;

    public function __construct(WeatherAPI $weatherAPI) {
        $this->weatherAPI = $weatherAPI;
    }

    public function getForecast($location) {
        return $this->weatherAPI->fetchForecast($location);
    }
}