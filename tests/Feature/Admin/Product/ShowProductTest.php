<?php

namespace Tests\Feature\Admin\Product;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;

class ShowProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_show_a_product_info(): void
    {
        $user = User::factory()->create(['role'=> 'admin']);
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->get(route('products.show', ['product' => $product->id]));

        $response->assertSee($product->name);
    }
}
