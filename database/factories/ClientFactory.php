<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'rut' => $this->faker->regexify('[0-9]{8}-[0-9K]'),
            'phone' => $this->faker->phoneNumber,
        ];
    }
}