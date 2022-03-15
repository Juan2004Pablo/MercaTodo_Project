<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->email_verified_at = now();
        $user->password = '12345678';
        $user->role = 'admin';
        $user->disable_at = null;

        $user->save();

        $client = new User;
        $client->name = 'User';
        $client->email = 'user@user.com';
        $client->email_verified_at = now();
        $client->password = '12345678';
        $client->role = 'client';
        $client->disable_at = null;

        $client->save();

        $product = new Product;
        $product->code = 'ABC123';
        $product->name = 'celular';
        $product->price = 4000;
        $product->quantity = 2;
        $product->description = 'xcjcndnn12345678';
        $product->disable_at = null;

        $product->save();
    }
}