<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    public function test_login_displays_the_login_form(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_login_displays_validation_errors(): void
    {
        $response = $this->post(route('login'), []);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    use RefreshDatabase;
    public function test_login_authenticades_and_redirects_user(): void
    {
        
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('home'));

        $this->assertAuthenticated($guard = null);
        $response->assertStatus(200);
    }

    public function test_user_can_be_registered(): void
    {
        $this->withoutExceptionHandling();
        $response = $this->post(route('register'), [
            'name' => 'Cristiano Ronaldo',
            'email' => 'cristiano@ronaldo.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);

        $response->assertRedirect(route('home'));
    }

    use RefreshDatabase;
    public function test_user_must_verify_email(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('home'));

        //$this->assertAuthenticated($guard = null);
        $response->assertStatus(200);
    }
}
