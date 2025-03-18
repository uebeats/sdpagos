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
                'subscription_id' => 1,
                'amount' => 100,
                'method' => 'transfer',
                'transaction_id' => '123456',
                'status' => 'successful',
                'paid_at' => Carbon::now(),
                'retry_count' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'subscription_id' => 2,
                'amount' => 200,
                'method' => 'mercadopago',
                'transaction_id' => '654321',
                'status' => 'successful',
                'paid_at' => Carbon::now(),
                'retry_count' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            
        ]);
    }
}