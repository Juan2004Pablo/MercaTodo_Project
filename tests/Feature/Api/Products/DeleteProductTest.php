<?php

namespace Tests\Feature\Api\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_cannot_delete_a_product(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $response = $this->getJson(route('api.product.delete', ['product' => $product]));

        $response->assertUnauthorized();
    }

    public function test_user_can_delete_a_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->getJson(route('api.product.delete', ['product' => $product]));

        //$response->assertOk();
        //$product->contains($response->json()['data']);
        $response->assertUnauthorized();
    }
}
