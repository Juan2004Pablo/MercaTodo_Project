<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminTest extends TestCase
{
    public function test_user_can_be_role_admin(): void
    {
        $response = $this->post(route('register'), [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'role' => 'admin',
        ]);
        if(auth()->user()->role === 'admin'){
            $response->assertRedirect(route('admin.index'));
            $this->assertAuthenticated($guard = null);
        } else{
            $response = $this->get('home');
            $response->assertStatus(302);
        }
    }
}
