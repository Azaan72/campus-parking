<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'email' => 'test@example.com',
            'firstname' => 'Test',
            'lastname' => 'User',
            'city' => 'Test City',
            'streetname' => 'Test Street',
            'house_number' => '123',
            'zipcode' => '1234 AB',
            'phone_number' => '0612345678',
            'country' => 'Testland',
        ]);

        $this->call([
            UserSeeder::class,
            ParkingSpotSeeder::class,
            VehicleSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
