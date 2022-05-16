<?php

namespace Database\seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreatUsersSeeder extends Seeder
{
    public function run(): void
    {
        $userFullAdmin = User::create([

            'name' => 'Full',
            'surname' => 'Admin',
            'identification' => '1000000000',
            'address' => 'Calle B # 54 38',
            'phone' => '3001111111',
            'email' => 'fulladmin@admin.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        $userFullAdmin->assignRole('FullAdmin');

        $userAdmin = User::create([

            'name' => 'admin',
            'surname' => 'Admin',
            'identification' => '1234567891',
            'address' => 'Avenida 76 B # 54 38',
            'phone' => '3002233444',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        $userAdmin->assignRole('Admin');

        $userclient = User::create([
            'name' => 'JUAN',
            'surname' => 'Pabon',
            'identification' => '1025000000',
            'address' => 'carrera 78 B # 00-00',
            'phone' => '3000000000',
            'email' => 'client@user.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        $userclient->assignRole('Client');

        $userGuest = User::create([
            'name' => 'Guest',
            'surname' => 'Guest',
            'identification' => '2222222222',
            'address' => 'Diagonal 7 sur # A',
            'phone' => '3000000000',
            'email' => 'guest@user.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        $userGuest->assignRole('Guest');

        $userSeller = User::create([
            'name' => 'Seller',
            'surname' => 'Seller',
            'identification' => '3333333333',
            'address' => 'street 32 norte # A',
            'phone' => '3000000000',
            'email' => 'seller@user.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        $userSeller->assignRole('Seller');
    }
}
