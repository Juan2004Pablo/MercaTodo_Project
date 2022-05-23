<?php

namespace Tests\Feature\Permission;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_permission_index_product(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.product.index'));

        $response->assertForbidden();
    }

    public function test_permission_create_product(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.product.store'));

        $response->assertForbidden();
    }

    public function test_permission_to_update_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->get(route('admin.product.update', ['product' => $product]));

        $response->assertForbidden();
    }

    public function test_permission_to_product_can_be_seen(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->get(route('admin.product.show', ['product' => $product]));
        $user = User::first();

        $response->assertForbidden();
    }

    public function test_permission_to_product_can_be_disabled(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->get(route('admin.product.destroy', ['product' => $product]));

        $response->assertForbidden();
    }
}
