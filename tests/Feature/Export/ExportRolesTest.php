<?php

namespace Tests\Feature\Export;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExportRolesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_export_roles(): void
    {
        $this->seed();
        $user = $this->user();

        $response = $this->actingAs($user)->get(route('roles.export'));

        $response->assertOk();
    }

    public function test_export_roles(): void
    {
        $this->seed();
        $user = $this->user();

        $response = $this->actingAs($user)->get(route('roles.export'));

        $response->assertDownload();
    }
    
    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}

