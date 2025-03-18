<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        Subscription::insert([
            [
                'client_id' => 1,
                'service_id' => 1,
                'start_date' => now(),
                'next_billing_date' => Carbon::now()->addMonth(),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id' => 2,
                'service_id' => 2,
                'start_date' => now(),
                'next_billing_date' => Carbon::now()->addYear(),
                'status' => 'paid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}