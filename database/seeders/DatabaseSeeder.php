<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;



class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'surname' => 'Admin',
            'identification' => '1000000000',
            'address' => 'carrera 40 A',
            'phone' => '3200000000',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);
        
        $client = User::create([
            'name' => 'JUAN',
            'surname' => 'Pabon',
            'identification' => '1025000000',
            'address' => 'carrera 70',
            'phone' => '3000000000',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);
        
        $roladmin = Role::create([
            'name' => 'Admin',
            'description' => 'Administrator',
        ]);

        $roluser = Role::create([
            'name' => 'User',
            'description' => 'User client',
        ]);

        $cat = Category::create([
            'name' => 'Tecno',
            'description' => 'Soy la categoria de tecno'
        ]);

        $dep = Category::create([
            'name' => 'Deporte',
            'description' => 'Soy la categoria de deporte'
        ]);

        $prod = Product::create([
            'code' => '123456',
            'name' => 'tablet',
            'quantity' => 20,
            'price' => 1000000,
            'description' => 'soy la mejor description del mundo',
            'status' => 'NEW',
            'category_id' => 1
        ]);
        
        $pro = Product::create([
            'code' => '123COM',
            'name' => 'Computador',
            'quantity' => 10,
            'price' => 2000000,
            'description' => 'soy el mejor del mundo',
            'status' => 'USED',
            'category_id' => 1
        ]);

        $admin->roles()->sync([$roladmin->id]);

        $client->roles()->sync([$roluser->id]);
    }
}
