<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Invoice;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear clientes
        Client::factory(10)->create()->each(function ($client) {
            // Crear servicios
            $service = Service::factory()->create();

            // Crear suscripción para cada cliente
            $subscription = Subscription::factory()->create([
                'client_id' => $client->id,
                'service_id' => $service->id,
            ]);

            // Crear pagos y facturas
            Payment::factory(2)->create(['subscription_id' => $subscription->id]);
            Invoice::factory(1)->create([
                'client_id' => $client->id,
                'subscription_id' => $subscription->id,
            ]);
        });
    }
}