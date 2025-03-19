<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition()
    {
        return [
            'client_id' => Client::factory(),
            'service_id' => Service::factory(),
            'status' => $this->faker->randomElement(['active', 'suspended', 'cancelled']),
            'start_date' => $this->faker->date,
            'next_payment_date' => $this->faker->date,
        ];
    }
}