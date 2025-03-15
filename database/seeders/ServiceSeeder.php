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
                'description' => 'Plan de hosting con 10GB de almacenamiento.',
                'price' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Soporte Técnico',
                'description' => 'Soporte técnico para sistemas y servidores.',
                'price' => 50.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}