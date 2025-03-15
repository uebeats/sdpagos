<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        Payment::insert([
            [
                'client_id' => 1,
                'subscription_id' => 1,
                'amount' => 10.00,
                'payment_date' => Carbon::now(),
                'status' => 'paid',
                'payment_method' => 'Mercado Pago',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id' => 2,
                'subscription_id' => 2,
                'amount' => 50.00,
                'payment_date' => Carbon::now(),
                'status' => 'pending',
                'payment_method' => 'Tarjeta de crédito',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}