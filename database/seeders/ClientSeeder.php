<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run()
    {
        Client::insert([
            [
                'name' => 'Juan Pérez',
                'rut' => '12345678-9',
                'email' => 'juan@example.com',
                'phone' => '987654321',
                'address' => 'Av. Siempre Viva 123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'María López',
                'rut' => '98765432-1',
                'email' => 'maria@example.com',
                'phone' => '987654322',
                'address' => 'Calle Falsa 456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}