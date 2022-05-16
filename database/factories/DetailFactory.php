<?php

namespace Database\Factories;

use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailFactory extends Factory
{
    protected $model = Detail::class;

    public function definition(): array
    {
        return [
            'quantity' => 1,
            'products_id' => Product::all()->random()->id,
            'unit_price' => Product::all()->random()->price,
            'order_id' => Order::all()->random()->id,
        ];
    }
}
