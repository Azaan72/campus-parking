<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenRouteService
{
    protected $baseUrl = 'https://api.openrouteservice.org/v2/';

    public function getRoute(float $startLat, float $startLng, float $endLat, float $endLng): array
    {
        $response = Http::get($this->baseUrl . 'directions/driving-car', [
            'api_key' => config('services.openrouteservice.key'),
            'start'   => "{$startLng},{$startLat}",
            'end'     => "{$endLng},{$endLat}",
        ]);

        if ($response->failed() || empty($response->json('features'))) {
            return [];
        }

        $feature = $response->json('features')[0];
        $summary = $feature['properties']['summary'];

        return [
            'distance_km'   => round($summary['distance'] / 1000, 1),
            'duration_min'  => round($summary['duration'] / 60),
            'coordinates'   => $feature['geometry']['coordinates'],
        ];
    }
}