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
                'amount' => 10.00,
                'billing_cycle' => 'monthly',
                'next_billing_date' => Carbon::now()->addMonth(),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_id' => 2,
                'service_id' => 2,
                'amount' => 50.00,
                'billing_cycle' => 'annually',
                'next_billing_date' => Carbon::now()->addYear(),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}