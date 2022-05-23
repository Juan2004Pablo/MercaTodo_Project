<?php

namespace Tests\Feature\Permission;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_permission_index_category(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.category.index'));

        $response->assertForbidden();
    }

    public function test_permission_create_category(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.category.store'));

        $response->assertForbidden();
    }

    public function test_permission_to_update_category(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.category.update', ['category' => $category]));

        $response->assertForbidden();
    }

    public function test_permission_to_category_can_be_seen(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.category.show', ['category' => $category]));

        $response->assertForbidden();
    }

    public function test_permission_to_category_can_be_disabled(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.category.destroy', ['category' => $category]));

        $response->assertForbidden();
    }
}
