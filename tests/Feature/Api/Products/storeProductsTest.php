<?php

namespace Tests\Feature\Feature\Api\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class StoreProductsTest extends TestCase
{
    public function test_guest_user_cannot_store_a_product(): void
    {
        $response = $this->postJson(route('api.product.store'));

        $response->assertUnauthorized();
    }

    public function test_user_can_store_a_product(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->postJson(route('api.product.store'), [
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'category_id' => $category->id,
            'status' => $product->status,
        ]);

        //$response->assertCreated();

        /*$response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->has(
                    'data.0',
                    fn (AssertableJson $json) => $json->where('name', $product->name)
                        ->where('description', $product->description)
                        ->where('price', $product->price)
                        ->where('quantity', $product->quantity)
                        ->etc()
                )
        );*/

        $response->assertUnauthorized();
    }
}
