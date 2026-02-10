<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = [
            [
                'status_of_reservation' => 'confirmed',
                'date_time' => '2024-07-01 10:00:00',
                'type_reservation' => 'hourly',
                'user_id' => 1,
                'parking_spot_id' => 1,
                'vehicle_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status_of_reservation' => 'pending',
                'date_time' => '2024-07-02 14:00:00',
                'type_reservation' => 'daily',
                'user_id' => 2,
                'parking_spot_id' => 2,
                'vehicle_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status_of_reservation' => 'cancelled',
                'date_time' => '2024-07-03 09:00:00',
                'type_reservation' => 'hourly',
                'user_id' => 3,
                'parking_spot_id' => 3,
                'vehicle_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Reservation::insert($reservations);
    }
}
