<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Client;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition()
    {
        return [
            'client_id' => Client::factory(),
            'subscription_id' => Subscription::factory(),
            'total_amount' => $this->faker->randomFloat(2, 10000, 50000),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(['unpaid', 'paid', 'overdue']),
        ];
    }
}