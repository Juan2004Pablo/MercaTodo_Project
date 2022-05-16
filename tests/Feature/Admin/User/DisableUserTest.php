<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Tests\TestCase;

class DisableUserTest extends TestCase
{
    public function test_user_is_disabled(): void
    {
        $user = User::factory()->create(['disable_at'=> now()]);

        $response = $this->actingAs($user)->get(route('admin.users.toggle', ['user' => $user->id]));

        $response->assertRedirect('login');
    }

    public function test_user_is_enabled(): void
    {
        $user = User::factory()->create(['disable_at'=> null]);
        $response = $this->actingAs($user)->get(route('home'));

        $this->assertAuthenticated($guard = null);
        $response->assertStatus(200);
    }

    public function test_users_can_be_enabled(): void
    {
        $user = User::factory()->create(['disable_at'=> now()]);
        $response = $this->actingAs($user)->get(route('admin.users.toggle', ['user' => $user->id]));

        $user->disable_at = null;
        $response = $this->actingAs($user)->get(route('home'));
        $this->assertAuthenticated($guard = null);
        $response->assertStatus(200);
    }

    public function test_users_can_be_disabled(): void
    {
        $user = User::factory()->create(['disable_at'=> null]);
        $response = $this->actingAs($user)->get(route('home'));

        $user->disable_at = now();
        $response = $this->actingAs($user)->get(route('admin.users.toggle', ['user' => $user->id]));

        $response->assertRedirect('login');
        $response->assertStatus(302);
    }
}
