<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => Str::random(6),
            'name' => $this->faker->words(2, true),
            'price' => $this->faker->randomDigitNotZero(),
            'quantity' => $this->faker->randomDigitNotZero(),
            'description' => $this->faker->words(5, true),
        ];
    }
}
