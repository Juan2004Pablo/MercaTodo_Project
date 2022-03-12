<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_of_users_created(): void
    {
        User::factory()->count(2)->create();
        $user = User::factory()->create(['role'=> 'admin']);
        $response = $this->actingAs($user)->get(route('users.index'));

        $response->assertOk();

        $user = User::all();

        $response->assertViewIs('admin.user.index');
        $response->assertViewHas('users', $user);
    }

    use RefreshDatabase;
    public function test_users_can_be_seen(): void
    {
        $this->withoutexceptionhandling();
        $user = User::factory()->create(['role'=> 'admin']);
        $response = $this->actingAs($user)->get(route('users.show', ['user' => $user->id]));
        $user = User::first();

        $response->assertViewIs('admin.user.show');
        $response->assertViewHas('user', $user);
    }

    /*
    public function test_users_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this->put('/admin/crudUsers/' . $user->id, [
            'name' => 'Juan',
            'email' => 'juan@user.com',
            'role' => 'client',
            'status' => 1,
        ]);

        $this->assertCount(1, User::all());

        $user = $user->fresh();

        $this->assertEquals($user->name, 'Juan');
        $this->assertEquals($user->email, 'juan@user.com');
        $this->assertEquals($user->role, 'client');
        $this->assertEquals($user->status, 1);

        $response->assertRedirect('/admin/crudUsers/{user}' . $user->id);
    }*/

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
        $this->withoutexceptionhandling();
        $user = User::factory()->create(['disable_at'=> now()]);
        $response = $this->actingAs($user)->get(route('admin.users.toggle', ['user' => $user->id]));

        $user->disable_at = null;
        $response = $this->actingAs($user)->get(route('home'));
        $this->assertAuthenticated($guard = null);
        $response->assertStatus(200);
        
        //$response->assertViewIs('admin.user.index');
        //$response->assertViewHas('users', $user);
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
