<?php

namespace Database\Factories;

use App\MercatodoModels\Order;
use App\MercatodoModels\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'code' => 'FBC456',
            'total' => '1000000',
            'user_id' => User::all()->random()->id,
            'name_receive' => $this->faker->name,
            'surname' => $this->faker->lastName,
            'address' => $this->faker->address,
            'phone' => User::all()->random()->phone,
        ];
    }
}
