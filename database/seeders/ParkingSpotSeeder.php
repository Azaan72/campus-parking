<?php

namespace Database\Seeders;

use App\Models\ParkingSpot;
use Illuminate\Database\Seeder;

class ParkingSpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parkingSpots = [
            [
                'location' => 'Verdieping -1, Zone A, P1',
                'type' => 'normal',
                'status' => 'available',
                'vehicle_fuel_type' => 'petrol',
            ],
            [
                'location' => 'Verdieping -1, Zone A, P2',
                'type' => 'electric',
                'status' => 'available',
                'vehicle_fuel_type' => 'electric',
            ],
            [
                'location' => 'Verdieping -2, Zone B, P5',
                'type' => 'disabled',
                'status' => 'occupied',
                'vehicle_fuel_type' => 'hybrid',
            ],
            [
                'location' => 'Buiten, Zone C, P12',
                'type' => 'compact',
                'status' => 'maintenance',
                'vehicle_fuel_type' => 'diesel',
            ],
        ];

        ParkingSpot::insert($parkingSpots);
    }
}
