<?php

namespace Tests\Feature\Permission;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class AdminUsersPermissionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_permission_index_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('user.index'));

        $response->assertForbidden();
    }

    public function test_permission_to_update_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('user.update', ['user' => $user]));

        $response->assertForbidden();
    }

    public function test_permission_to_user_can_be_seen(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('user.show', ['user' => $user]));
        $user = User::first();

        $response->assertForbidden();
    }

    public function test_permission_to_user_can_be_disabled(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('user.toggle', ['user' => $user]));

        $response->assertForbidden();
    }
}
