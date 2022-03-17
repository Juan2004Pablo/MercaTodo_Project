<?php

namespace Tests\Feature\Admin\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\TestCase;
use App\Models\User;

class ShowUserTest extends TestCase
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
        $user = User::factory()->create(['role'=> 'admin']);
        $response = $this->actingAs($user)->get(route('users.show', ['user' => $user->id]));
        $user = User::first();

        $response->assertViewIs('admin.user.show');
        //$response->assertViewHas('user', $user);
    }
}