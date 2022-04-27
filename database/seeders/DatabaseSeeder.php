<?php

namespace Database\seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(CreatUsersSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleHasPermissionSeeder::class);

        $c = Category::create([
            'name' => 'Tecno',
            'description' => 'Soy la categoria de tecno',
        ]);

        $d = Category::create([
            'name' => 'Deporte',
            'description' => 'Soy la categoria de deporte',
        ]);
    }
}
