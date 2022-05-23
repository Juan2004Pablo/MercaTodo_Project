<?php

namespace Tests\Feature\Export;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ExportUsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_export_users(): void
    {
        $this->seed();
        $user = $this->user();
        $usersExport = User::factory(8)->create();

        $response = $this->actingAs($user)->get(route('users.export'));

        $response->assertOk();
    }

    public function test_export_users(): void
    {
        $this->seed();
        $user = $this->user();
        $usersExport = User::factory(8)->create();

        $response = $this->actingAs($user)->get(route('users.export'));

        $response->assertDownload();
    }
    
    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}
