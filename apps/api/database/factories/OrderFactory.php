<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $status = fake()->randomElement(['open', 'paid']);

        return [
            'customer_id' => Customer::inRandomOrder()->first()?->id ?? Customer::factory(),
            'status'      => $status,
            'paid_at'     => $status === 'paid'
                ? fake()->dateTimeBetween('-1 year', 'now')
                : null,
            'total'       => fake()->randomFloat(2, 10, 5000),
        ];
    }
}