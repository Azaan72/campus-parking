<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'location_name' => 'Amsterdam',
                'latitude' => 52.3676,
                'longitude' => 4.9041,
                'type' => 'paid'
            ],
            [
                'location_name' => 'Rotterdam',
                'latitude' => 51.9244,
                'longitude' => 4.4777,
                'type' => 'paid'
            ],
            [
                'location_name' => 'Utrecht',
                'latitude' => 52.0907,
                'longitude' => 5.1214,
                'type' => 'free'
            ],
            [
                'location_name' => 'Eindhoven',
                'latitude' => 51.4416,
                'longitude' => 5.4697,
                'type' => 'free'
            ],
            [
                'location_name' => 'Groningen',
                'latitude' => 53.2194,
                'longitude' => 6.5665,
                'type' => 'permit'
            ],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
