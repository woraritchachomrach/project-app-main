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
                'name' => 'นายสมชาย ใจดี',
                'password' => bcrypt('22222'),
                'role' => 'driver',
            ]
        );

        User::updateOrCreate(
            ['email' => 'driver2@example.com'],
            [
                'name' => 'นางสาวสุดา โครตช้า',
                'password' => bcrypt('22222'),
                'role' => 'driver',
            ]
        );

        User::updateOrCreate(
            ['email' => 'driver3@example.com'],
            [
                'name' => 'นายสมหมาย หวังดี',
                'password' => bcrypt('22222'),
                'role' => 'driver',
            ]
        );

        User::updateOrCreate(
            ['email' => 'driver4@example.com'],
            [
                'name' => 'นางสาวจันทร์เพ็ญ ทองปลอม',
                'password' => bcrypt('22222'),
                'role' => 'driver',
            ]
        );

    }
}
