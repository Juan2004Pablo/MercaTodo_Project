<?php

namespace Tests\Feature\Admin\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\TestCase;
use App\Models\User;

class UpdateUserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
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
}
