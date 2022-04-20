<?php

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $useradmin = User::create([

            'name' => 'admin',
            'surname' => 'Admin',
            'identification' => '1234567891',
            'address' => 'Avenida 76 B # 54 38',
            'phone' => '3002233444',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        $userclient = User::create([
            'name' => 'JUAN',
            'surname' => 'Pabon',
            'identification' => '1025000000',
            'address' => 'carrera 78 B # 00-00',
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

        $c = Category::create([
            'name' => 'Tecno',
            'description' => 'Soy la categoria de tecno',
        ]);

        $d = Category::create([
            'name' => 'Deporte',
            'description' => 'Soy la categoria de deporte',
        ]);

        $useradmin->roles()->sync([$roladmin->id]);

        $userclient->roles()->sync([$roluser->id]);
    }
}
