<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'driver1@example.com'],
            [
                'name' => 'Driver One',
                'password' => bcrypt('22222'),
                'role' => 'driver',
            ]
        );

        User::updateOrCreate(
            ['email' => 'driver2@example.com'],
            [
                'name' => 'Driver Two',
                'password' => bcrypt('22222'),
                'role' => 'driver',
            ]
        );
    }
}
