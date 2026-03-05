<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenMeteoService
{
    protected $baseUrl = 'https://api.open-meteo.com/v1/';

    public function getForecastForHour(float $lat, float $lng, string $datetime): array
    {
        $dt       = new \DateTime($datetime);
        $date     = $dt->format('Y-m-d');
        $hourTarget = $dt->format('Y-m-d\TH:00');

        $before = (clone $dt)->modify('-1 day')->format('Y-m-d');
        $after  = (clone $dt)->modify('+1 day')->format('Y-m-d');

        $response = Http::get($this->baseUrl . 'forecast', [
            'latitude'   => $lat,
            'longitude'  => $lng,
            'hourly'     => 'temperature_2m,precipitation_probability,weathercode,windspeed_10m',
            'start_date' => $before,
            'end_date'   => $after,
            'timezone'   => 'auto',
        ]);

        if ($response->failed()) {
            return [];
        }

        $hourly = $response->json('hourly');
        $index  = array_search($hourTarget, $hourly['time']);

        if ($index === false) {
            $index = (int) $dt->format('H');
        }

        return [
            'temperature'  => $hourly['temperature_2m'][$index],
            'rain_chance'  => $hourly['precipitation_probability'][$index],
            'wind_speed'   => $hourly['windspeed_10m'][$index],
            'weather_code' => $hourly['weathercode'][$index],
        ];
    }
}