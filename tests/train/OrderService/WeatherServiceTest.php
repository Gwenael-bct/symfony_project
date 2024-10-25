<?php

namespace App\Tests\train\OrderService;

use App\traintest\meteo\WeatherAPI;
use App\traintest\meteo\WeatherService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WeatherServiceTest extends WebTestCase
{
    public function testWeather() {
        $mockapi = $this->createMock(WeatherApi::class);
        $mockapi->method('fetchForecast')->willReturn([
            'temperature' => 20,
            'description' => 'Clear sky',
        ]);
        // Crée une instance de WeatherService avec le mock
        $weatherService = new WeatherService($mockapi);

        // Vérifie que getForecast retourne les bonnes données
        $forecast = $weatherService->getForecast('Paris');
        $this->assertEquals(20, $forecast['temperature']);
        $this->assertEquals('Clear sky', $forecast['description']);
    }
}