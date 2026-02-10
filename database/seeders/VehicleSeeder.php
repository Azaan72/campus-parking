<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'license_plate' => 'ABC-123',
                'model' => 'Model S',
                'brand' => 'Tesla',
                'year' => 2020,
                'fuel_type' => 'Electric',
                'vehicle_type' => 'Sedan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'license_plate' => 'XYZ-789',
                'model' => 'Civic',
                'brand' => 'Honda',
                'year' => 2018,
                'fuel_type' => 'Gasoline',
                'vehicle_type' => 'Hatchback',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'license_plate' => 'LMN-456',
                'model' => 'F-150',
                'brand' => 'Ford',
                'year' => 2019,
                'fuel_type' => 'Diesel',
                'vehicle_type' => 'Truck',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Vehicle::insert($vehicles);
    }
}
