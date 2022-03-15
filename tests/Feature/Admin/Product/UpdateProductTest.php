<?php

namespace Tests\Feature\Admin\Product;

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
    public function test_a_product_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create(['role'=> 'admin']);
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->get(route('products.update', ['product' => $product->id]), [
            'code' => 'PRD1234567',
            'name' => 'Test product',
            'price' => 100,
            'quantity' => 5,
            'description' => 'Amazing test product',
            'images' => [
               UploadedFile::fake()->image('product.png', 500, 250)->size(50),
            ]
        ]);

        $this->assertCount(1, Product::all());

        $product = $product->fresh();

        $this->assertEquals($product->code, 'PRD1234567');
        $this->assertEquals($product->name, 'Test product');
        $this->assertEquals($product->price, 100);
        $this->assertEquals($product->quantity, 5);
        $this->assertEquals($product->description, 'Amazing test product');
        $this->assertEquals($product->images, [
            UploadedFile::fake()->image('product.png')->size(50),
            ]);

        $response->assertRedirect('products.update', ['product' => $product->id]);
    }

}
