<?php

namespace Tests\Feature\Permission;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_example2()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /*public function test_import_products(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('products.import'));

        $response->assertForbidden();
    }

    public function test_import_categories(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('categories.import'));

        $response->assertForbidden();
    }

    public function test_import_users(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('users.import'));

        $response->assertForbidden();
    }

    public function test_import_roles(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('roles.import'));

        $response->assertForbidden();
    }*/
}
