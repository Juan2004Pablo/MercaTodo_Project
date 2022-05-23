<?php

namespace Tests\Feature\Permission;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminRolePermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_permission_index_role(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('role.index'));

        $response->assertForbidden();
    }

    public function test_permission_create_role(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('role.store'));

        $response->assertForbidden();
    }

    public function test_permission_to_update_role(): void
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'Subdi']);

        $response = $this->actingAs($user)->get(route('role.update', ['role' => $role]));

        $response->assertForbidden();
    }

    public function test_permission_to_role_can_be_seen(): void
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'Subdire']);

        $response = $this->actingAs($user)->get(route('role.show', ['role' => $role]));

        $response->assertForbidden();
    }

    public function test_permission_to_role_can_be_disabled(): void
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'Subdirect']);

        $response = $this->actingAs($user)->get(route('role.destroy', ['role' => $role]));

        $response->assertForbidden();
    }
}
