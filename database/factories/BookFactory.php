<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4, false),
            'slug' => Str::slug(fake()->sentence(4, false)),
            'author' => fake()->name(),
            'publisher' => fake()->company(),
            'price' => fake()->numberBetween(1000, 100000),
            'year' => fake()->numberBetween(1900, 2024),
            'stock' => fake()->numberBetween(0, 100),
            'updatedBy' => User::factory(),
        ];
    }
}
