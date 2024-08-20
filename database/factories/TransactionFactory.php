<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_name' => fake()->name(),
            'code' => "INV-" . fake()->numberBetween(100000, 999999),
            'total_price' => fake()->numberBetween(100000, 9999999),
            'status' => fake()->numberBetween(0, 2),
            'updated_by' => User::factory(),
        ];
    }
}
