<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Hosting', 'Desarrollo Web', 'Mantenimiento Web']),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10000, 50000),
            'billing_cycle' => $this->faker->randomElement(['monthly', 'quarterly', 'yearly']),
        ];
    }
}