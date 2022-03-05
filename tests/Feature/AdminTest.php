<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminTest extends TestCase
{
    public function test_user_can_be_role_admin()
    {
        $this->withoutExceptionHandling();
        $response = $this->post(route('register'), [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'role' => 'admin'
        ]);
        if(auth()->user()->role === 'admin'){
            $response->assertRedirect(route('admin.index'));
        } else{
            $response = $this->get('/');
            $response->assertStatus(200);
        }
        
        $this->assertAuthenticated($guard = null);

    }

    /*
    use RefreshDatabase;
    public function test_user_can_be_role_admin_auth()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->count(1)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'role' => 'admin'
        ]);
        
        $response->assertRedirect(route('admin'));
        $this->assertAuthenticatedAs($user, $guard = null);

    }*/
}
