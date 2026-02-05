<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'prefix' => null,
                'city' => 'Amsterdam',
                'streetname' => 'Keizersgracht',
                'house_number' => '12A',
                'zipcode' => '1015CJ',
                'country' => 'Netherlands',
                'phone_number' => '+31612345678',
                'email' => 'john.doe@example.com',
                'password' => bcrypt('password123'), // encrypt wachtwoord
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Jane',
                'lastname' => 'Smith',
                'prefix' => 'van',
                'city' => 'Rotterdam',
                'streetname' => 'Coolsingel',
                'house_number' => '34B',
                'zipcode' => '3012AG',
                'country' => 'Netherlands',
                'phone_number' => '+31623456789',
                'email' => 'jane.smith@example.com',
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Mark',
                'lastname' => 'Johnson',
                'prefix' => null,
                'city' => 'Utrecht',
                'streetname' => 'Vredenburg',
                'house_number' => '8',
                'zipcode' => '3511BD',
                'country' => 'Netherlands',
                'phone_number' => '+31634567890',
                'email' => 'mark.johnson@example.com',
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Lisa',
                'lastname' => 'de Vries',
                'prefix' => null,
                'city' => 'Eindhoven',
                'streetname' => 'Stratumseind',
                'house_number' => '22',
                'zipcode' => '5611ER',
                'country' => 'Netherlands',
                'phone_number' => '+31645678901',
                'email' => 'lisa.devries@example.com',
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstname' => 'Tom',
                'lastname' => 'Bakker',
                'prefix' => 'van de',
                'city' => 'Den Haag',
                'streetname' => 'Spui',
                'house_number' => '5C',
                'zipcode' => '2511BT',
                'country' => 'Netherlands',
                'phone_number' => '+31656789012',
                'email' => 'tom.bakker@example.com',
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        User::insert($users);
    }
}
