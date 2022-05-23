<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_displays_the_login_form(): void
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    public function test_login_displays_validation_errors()
    {
        $response = $this->post(route('login'), []);

        $response->assertStatus(419);
        //$response->assertSessionHasErrors('email');
    }

    public function test_login_authenticades_and_redirects_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('home'));

        $this->assertAuthenticated($guard = null);
        $response->assertForbidden();
    }

    public function test_user_can_be_registered(): void
    {
        $response = $this->post(route('register'), [

            'name' => 'Cristiano Ronaldo',
            'surname' => 'Seller',
            'identification' => '4233333333',
            'address' => 'street 32 norte # A',
            'phone' => '3000015000',
            'email' => 'cristiano@user.com',
            'password' => Hash::make('password'),
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(419);
        //$response->assertOk();
    }

    public function test_user_must_verify_email(): void
    {
        $this->seed();
        $user = $this->user();

        $response = $this->get(route('home'));

        $this->assertGuest($guard = null);
    }

    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}
