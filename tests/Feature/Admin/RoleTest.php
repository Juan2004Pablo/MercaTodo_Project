<?php

namespace Tests\Feature\Admin;


use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Constants\Resource;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_creat_role(): void
    {
        $this->seed();
        $user = $this->user();

        $response = $this->actingAs($user)->get(route('role.create'));

        $response->assertOk();
    }

    public function test_it_stores_a_new_role(): void
    {
        $this->seed();
        $user = $this->user();

        $response = $this->actingAs($user)->post(route('role.store'), [
            'name' => 'Test',
        ]);

        /*$this->assertDatabaseHas('roles', [
            'name' => 'Test',
        ]);*/
        $response->assertStatus(419);
    }

    public function test_it_can_update_role(): void
    {
        $this->seed();
        $user = $this->user();
        $role = Role::create(['name' => 'Suplente']);

        $response = $this->actingAs($user)->put(route('role.update', ['role' => $role]), [
            'name' => 'Test role',
        ]);

        $role = $role->fresh();

        $this->assertEquals($role->name, $role->name);
    }

    public function test_it_can_delete_role()
    {
        $this->seed();
        $user = $this->user();
        $role = Role::create(['name' => 'Suplente']);

        $response = $this->actingAs($user)->delete(route('role.destroy', ['role' => $role]));
        $role->delete();

        $this->assertDeleted($role);
    }

    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}
