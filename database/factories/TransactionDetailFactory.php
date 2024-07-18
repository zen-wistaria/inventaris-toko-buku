<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionDetail>
 */
class TransactionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_id' => Transaction::factory(),
            'book_id' => Book::factory(),
            'total_books' => fake()->numberBetween(0, 100),
            'total_price' => fake()->numberBetween(1000000, 9999999),
        ];
    }
}
