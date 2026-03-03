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
            ['location' => 'Amsterdam'],
            ['location' => 'Rotterdam'],
            ['location' => 'Utrecht'],
            ['location' => 'Eindhoven'],
            ['location' => 'Groningen'],
        ];

        Location::insert($locations);
    }
} 