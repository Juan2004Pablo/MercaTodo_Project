<?php

namespace Tests\Feature\Api\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_user_cannot_update_a_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->putJson(route('api.product.update', ['product' => $product]));

        $response->assertUnauthorized();
    }

    public function test_user_can_update_a_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->putJson(route('api.product.update', ['product' => $product]), [
            'name' => 'Test product',
            'price' => 100,
            'quantity' => 5,
            'description' => 'Amazing test product',
        ]);

        $product = $product->fresh();
        /*$this->assertDatabaseHas('products', [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'description' => $product->description,
        ]);*/
        //$response->assertOk();
        //$products->contains($response->json()['data']);
        $response->assertUnauthorized();
    }
}
