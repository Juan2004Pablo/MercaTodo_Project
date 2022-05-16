<?php

namespace Tests\Feature\Api\Products;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class indexProductsTest extends TestCase
{
    public function testGuestUserCannotSeeProductsList()
    {
        $response = $this->getJson(route('api.product.index'));

        $response->assertUnauthorized();
    }

    public function testUserCanSeeProductsList()
    {
        $user = User::factory()->create();
        $products = Product::factory(5)->create();

        $response = $this->actingAS($user)->getJson(route('api.product.index'));

        $response->assertOk();
        $products->contains($response->json()['data']);
    }
}
