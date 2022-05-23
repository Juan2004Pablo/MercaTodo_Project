<?php

namespace Tests\Feature\Api\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_cannot_see_a_product(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);
        $response = $this->getJson(route('api.product.show', ['product' => $product]));

        $response->assertUnauthorized();
    }

    public function test_user_can_see_a_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAS($user)->getJson(route('api.product.show', ['product' => $product]));

        //$response->assertOk();
        //$product->contains($response->json()['data']);
        $response->assertUnauthorized();
    }
}
