<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenStreetMapService
{
    protected $baseUrl = 'https://nominatim.openstreetmap.org/';

    public function geocode(string $address): array
    {
        $response = Http::withHeaders([
            'User-Agent' => 'CampusParkingApp contact@jouwapp.nl',
        ])->get($this->baseUrl . 'search', [
            'format' => 'json',
            'q'      => $address,
            'limit'  => 1,
        ]);

        if ($response->failed() || empty($response->json())) {
            return [];
        }

        $result = $response->json()[0];

        return [
            'lat' => (float) $result['lat'],
            'lng' => (float) $result['lon'],
        ];
    }
}