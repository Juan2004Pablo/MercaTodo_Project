<?php

namespace Tests\Feature\Permission;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CartPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_permission_cart_show(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('cart.show'));

        $response->assertForbidden();
    }

    public function test_permission_cart_add(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->get(route('cart.add', ['id' => $product]));

        $response->assertForbidden();
    }

    public function test_permission_to_update_cart(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->get(route('cart.update', ['id' => $product]));

        $response->assertStatus(500);
    }

    public function test_permission_to_cart_trash(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('cart.trash'));

        $response->assertForbidden();
    }

    public function test_permission_to_cart_delete(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->get(route('cart.delete', ['id' => $product->id]));

        $response->assertForbidden();
    }
}
