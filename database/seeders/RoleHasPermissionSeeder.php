<?php

namespace Database\seeders;

use App\Constants\Resource;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    public const ADMINPERMISSIONS = [Resource::USER_INDEX, Resource::USER_UPDATE, Resource::USER_SHOW, Resource::USER_DISABLE, Resource::ROLE_INDEX,
        Resource::ROLE_CREATE, Resource::ROLE_UPDATE, Resource::ROLE_SHOW, Resource::ROLE_DISABLE, Resource::CATEGORY_INDEX, Resource::CATEGORY_CREATE,
        Resource::CATEGORY_SHOW, Resource::CATEGORY_UPDATE, Resource::CATEGORY_DISABLE, Resource::PRODUCT_INDEX, Resource::PRODUCT_CREATE, Resource::PRODUCT_SHOW,
        Resource::PRODUCT_UPDATE, Resource::PRODUCT_DISABLE, Resource::USERS_IMPORT, Resource::HOME_INDEX, ];

    public const SELLERPERMISSIONS = [Resource::CATEGORY_INDEX, Resource::CATEGORY_CREATE, Resource::CATEGORY_SHOW, Resource::CATEGORY_UPDATE, Resource::CATEGORY_DISABLE,
        Resource::PRODUCT_INDEX, Resource::PRODUCT_CREATE, Resource::PRODUCT_SHOW, Resource::PRODUCT_UPDATE, Resource::PRODUCT_DISABLE, Resource::SHOW_PRODUCT, Resource::CART_SHOW,
        Resource::CART_ADD, Resource::CART_DELETE, Resource::CART_TRASH, Resource::CART_UPDATE, Resource::DETAIL_INDEX, Resource::ORDER_INDEX, Resource::ORDER_SHOW, Resource::PAY_CREATE,
        Resource::PAY_REDIRECTION, Resource::PAY_DATAOFORDER, Resource::PAY_CONSULTPAYMENT, Resource::PAY_UPDATEDATA, Resource::PAY_SHOW, Resource::PAY_UPDATEORDER, Resource::PAY_SHOWALL,
        Resource::PAY_RETRY, Resource::SHOW_PRODUCT, Resource::HOME_INDEX, ];

    public const GUESTPERMISSIONS = [Resource::HOME_INDEX, Resource::SHOW_PRODUCT];

    public const CLIENTPERMISSIONS = [Resource::SHOW_PRODUCT, Resource::CART_SHOW, Resource::CART_ADD, Resource::CART_DELETE, Resource::CART_TRASH,
        Resource::CART_UPDATE, Resource::DETAIL_INDEX, Resource::ORDER_INDEX, Resource::ORDER_SHOW, Resource::PAY_CREATE,
        Resource::PAY_REDIRECTION, Resource::PAY_DATAOFORDER, Resource::PAY_CONSULTPAYMENT, Resource::PAY_UPDATEDATA, Resource::PAY_SHOW,
        Resource::PAY_UPDATEORDER, Resource::PAY_SHOWALL, Resource::PAY_RETRY, Resource::HOME_INDEX, ];

    public function run(): void
    {
        $this->createAdminRolePermissions();
        $this->createFullAdminRolePermissions();
        $this->createSellerRolePermissions();
        $this->createGuestRolePermissions();
        $this->createClientRolePermissions();
    }

    private function createFullAdminRolePermissions(): void
    {
        $role = Role::findByName('FullAdmin');
        $role->syncPermissions(Permission::all());
    }

    private function createAdminRolePermissions(): void
    {
        $role = Role::findByName('Admin');

        $permissions = self::ADMINPERMISSIONS;

        $role->syncPermissions($permissions);
    }

    private function createSellerRolePermissions(): void
    {
        $role = Role::findByName('Seller');

        $permissions = self::SELLERPERMISSIONS;

        $role->syncPermissions($permissions);
    }

    private function createGuestRolePermissions(): void
    {
        $role = Role::findByName('Guest');

        $permissions = self::GUESTPERMISSIONS;

        $role->syncPermissions($permissions);
    }

    private function createClientRolePermissions(): void
    {
        $role = Role::findByName('Client');

        $permissions = self::CLIENTPERMISSIONS;

        $role->syncPermissions($permissions);
    }
}
