<?php

namespace Database\seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['Admin', 'FullAdmin', 'Guest', 'Seller', 'Client'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
