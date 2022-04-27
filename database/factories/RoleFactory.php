<?php

namespace database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->text(8),
        ];
    }
}
