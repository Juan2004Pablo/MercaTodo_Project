<?php

namespace Tests\Feature\Permission;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_permission_home(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('home'));

        $response->assertForbidden();
    }

    public function test_permission_product_show_in_home(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->get(route('product', ['product' => $product]));

        $response->assertForbidden();
    }
}
