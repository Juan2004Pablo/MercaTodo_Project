<?php

namespace Tests\Feature\Report;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReportUsersTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_users_report(): void
    {
        $this->seed();
        $user = $this->user();

        $response = $this->actingAs($user)->get(route('users.report.index'));

        $response->assertOk();
    }

    public function test_generate_users_report(): void
    {
        $this->seed();
        $user = $this->user();
        $usersExport = User::factory(8)->create();

        $response = $this->actingAs($user)->post(route('users.report.generate', [
            'initialDate' => now(),
            'endDate' => now(),
        ]));

        $response->assertStatus(419);
    }

    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}
