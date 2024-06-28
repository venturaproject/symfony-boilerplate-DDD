<?php

// src/Controller/WeatherController.php
namespace App\Infrastructure\Controller;

use App\Infrastructure\Service\OpenWeatherMapService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends AbstractController
{
    private $openWeatherMapService;

    public function __construct(OpenWeatherMapService $openWeatherMapService)
    {
        $this->openWeatherMapService = $openWeatherMapService;
    }

    #[Route('/weather', name: 'weather')]
    public function getWeather(Request $request): JsonResponse
    {
        $city = $request->query->get('city', 'London');
        $weatherData = $this->openWeatherMapService->getWeatherDataByCity($city);
        $weatherData['request_time'] = (new \DateTime())->format('Y-m-d H:i:s');

        return $this->json($weatherData);
    }
}