<?php

namespace App\Infrastructure\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenWeatherMapService
{
    private $client;
    private $apiKey;
    private $apiUrl;

    public function __construct(HttpClientInterface $client, string $apiKey, string $apiUrl)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    public function getWeatherDataByCity(string $city): array
    {
        $response = $this->client->request('GET', $this->apiUrl, [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric',
            ],
        ]);

        $data = $response->toArray();

        return [
            'temp_min' => $data['main']['temp_min'],
            'temp_max' => $data['main']['temp_max'],
        ];
    }
}