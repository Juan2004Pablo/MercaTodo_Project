<?php

namespace Tests\Feature\Import;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportUsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_cannot_import_users(): void
    {
        $this->seed();
        $user = $this->user();

        $response = $this->actingAs($user)->post(route('users.import', []));

        $response->assertStatus(419);
    }

    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}
