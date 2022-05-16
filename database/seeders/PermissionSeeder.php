<?php

namespace Database\seeders;

use App\Constants\Resource;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Resource::supported() as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
