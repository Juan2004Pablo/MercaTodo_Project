<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->text(10),
            'category_id' => 1,
            'quantity' => '18',
            'price' => '500000',
            'description' => $this->faker->text(125),
            'status' => 'New',
        ];
    }
}
