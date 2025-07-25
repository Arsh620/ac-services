<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'name' => 'AC Installation',
            'description' => 'Professional installation of all types of air conditioning systems',
            'price' => 150.00
        ]);

        Service::create([
            'name' => 'AC Repair',
            'description' => 'Quick and reliable repair services for all AC brands and models',
            'price' => 80.00
        ]);

        Service::create([
            'name' => 'AC Maintenance',
            'description' => 'Regular maintenance to keep your AC running efficiently',
            'price' => 60.00
        ]);

        Service::create([
            'name' => 'AC Cleaning',
            'description' => 'Deep cleaning services to improve air quality and efficiency',
            'price' => 40.00
        ]);
    }
}