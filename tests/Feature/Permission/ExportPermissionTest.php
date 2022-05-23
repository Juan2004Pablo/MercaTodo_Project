<?php

namespace Tests\Feature\Permission;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class ExportPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_export_products(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('products.export'));

        $response->assertForbidden();
    }

    public function test_export_categories(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('categories.export'));

        $response->assertForbidden();
    }

    public function test_export_users(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('users.export'));

        $response->assertForbidden();
    }

    public function test_export_roles(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('roles.export'));

        $response->assertForbidden();
    }
}
