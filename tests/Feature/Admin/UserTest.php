<?php

namespace Tests\Feature\Admin;

use App\Constants\Resource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_of_users_created(): void
    {
        $this->seed();
        $user = $this->userEnabled();
        $response = $this->actingAs($user)->get(route('user.index'));

        $response->assertViewIs('user.index');
    }

    public function test_users_can_be_seen(): void
    {
        $this->seed();
        $user = $this->userEnabled();
        $response = $this->actingAs($user)->get(route('user.show', ['user' => $user]));

        $response->assertViewIs('user.show');
    }

    public function test_user_is_disabled(): void
    {
        $this->seed();
        $user = $this->userDisabled();
        $response = $this->actingAs($user)->get(route('user.toggle', ['user' => $user]));

        $response->assertRedirect('login');
    }

    public function test_user_can_be_updated()
    {
        $this->seed();
        $user = $this->userEnabled();
        $response = $this->actingAs($user)->put(route('user.update', ['user' => $user]));

        $this->assertEquals($user->name, $user->name);
        $this->assertEquals($user->email, $user->email);
    }

    public function test_user_is_enabled(): void
    {
        $this->seed();
        $user = $this->userEnabled();
        $response = $this->actingAs($user)->get(route('home'));

        $this->assertAuthenticated($guard = null);
        $response->assertOk();
    }

    public function test_users_can_be_enabled(): void
    {
        $this->seed();
        $user = $this->userDisabled();

        $response = $this->actingAs($user)->get(route('user.toggle', ['user' => $user]));

        $user->disable_at = null;
        $response = $this->actingAs($user)->get(route('home'));
        $this->assertAuthenticated($guard = null);
        $response->assertOk();
    }

    public function test_users_can_be_disabled(): void
    {
        $this->seed();
        $user = $this->userEnabled();
        $response = $this->actingAs($user)->get(route('home'));

        $user->disable_at = now();
        $response = $this->actingAs($user)->get(route('user.toggle', ['user' => $user]));

        $response->assertRedirect('login');
        $response->assertStatus(302);
    }

    private function userEnabled(): User
    {
        $user = User::factory()->create(['disable_at'=> null]);
        $user->assignRole('FullAdmin');

        return $user;
    }

    private function userDisabled(): User
    {
        $user = User::factory()->create(['disable_at'=> now()]);
        $user->assignRole('FullAdmin');

        return $user;
    }
}
