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
            ['location_name' => 'Amsterdam'],
            ['location_name' => 'Rotterdam'],
            ['location_name' => 'Utrecht'],
            ['location_name' => 'Eindhoven'],
            ['location_name' => 'Groningen'],
        ];

        Location::insert($locations);
    }
} 