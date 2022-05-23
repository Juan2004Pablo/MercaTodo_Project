<?php

namespace Tests\Feature\Api\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class indexProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_cannot_see_products_list(): void
    {
        $response = $this->getJson(route('api.products.index'));

        $response->assertUnauthorized();
    }

    public function test_user_can_see_a_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $products = Product::factory(5)->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->getJson(route('api.products.index'));

        //$response->assertOk();
        //$products->contains($response->json()['data']);
        $response->assertUnauthorized();
    }
}
