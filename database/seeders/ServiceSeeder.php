<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        Service::insert([
            [
                'name' => 'Hosting Básico',
                'price' => 15000.00,
                'billing_cycle' => 'monthly',
                'description' => 'Hosting básico para sitios web pequeños.'
            ],
            [
                'name' => 'Hosting Avanzado',
                'price' => 200000.00,
                'billing_cycle' => 'annual',
                'description' => 'Hosting avanzado para sitios web medianos.'
            ],
        ]);
    }
}