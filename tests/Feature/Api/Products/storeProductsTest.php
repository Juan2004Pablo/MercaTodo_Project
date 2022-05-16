<?php

namespace Tests\Feature\Feature\Api\Products;

use Tests\TestCase;

class storeProductsTest extends TestCase
{
    public function testGuestUserCannotStoreAProduct()
    {
        $response = $this->postJson(route('api.product.store'));

        $response->assertUnauthorized();
    }

    public function testUserCanStoreAProduct()
    {
        $user = User::factory()->create();
        $product = Product::factory()->make();

        $response = $this->actingAs($user)->postJson(route('api.product.store'), [
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'quantity' => $product->quantity,
            'category_id' => $product->category_id,
            'status' => $product->status,
        ]);

        $response->assertCreated();

        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data')
                ->has(
                    'data.0',
                    fn (AssertableJson $json) => $json->where('name', $product->name)
                        ->where('description', $product->description)
                        ->where('price', $post->price)
                        ->where('quantity', $product->quantity)
                        ->etc()
                )
        );
    }
}
