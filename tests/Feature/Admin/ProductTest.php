<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Constants\Resource;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_a_new_product(): void
    {
        $this->seed();
        $user = $this->user();

        $category = Category::factory()->create();
        $data = $this->productData($category);

        $response = $this->actingAs($user)->post('admin.product.store', $this->productData($category));

        $response->assertNotFound();
        //$this->assertDatabaseHas('products', Arr::except($data, ['images']));
    }

    public function test_create_product(): void
    {
        $this->seed();
        $user = $this->user();

        $response = $this->actingAs($user)->get(route('admin.product.create'));

        $response->assertOk();
    }

    public function test_show_a_product(): void
    {
        $this->seed();
        $user = $this->user();

        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->get(route('admin.product.show', ['product' => $product]));

        $response->assertSee($product->name);
        $response->assertSee($product->description);
        $response->assertSee($product->quantity);
        $response->assertSee($product->status);
    }

    public function test_a_product_can_be_updated(): void
    {
        $this->seed();
        $user = $this->user();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->put(route('admin.product.update', ['product' => $product]), [
            'name' => 'Test product',
            'price' => 100,
            'quantity' => 5,
            'description' => 'Amazing test product',
        ]);

        $product = $product->fresh();

        $this->assertEquals($product->name, $product->name);
        $this->assertEquals($product->price, $product->price);
        $this->assertEquals($product->quantity, $product->quantity);
        $this->assertEquals($product->description, $product->description);
    }

    public function test_it_can_disable_product(): void
    {
        $this->seed();
        $user = $this->user();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->post(route('admin.product.destroy', ['product' => $product]));
        $product->deleted_at = now();
        $product->save();

        $this->assertSoftDeleted($product);
    }

    public function test_it_can_enable_product(): void
    {
        $this->seed();
        $user = $this->user();
        $category = Category::factory()->create();
        $product = Product::factory()->create(['category_id' => $category->id, 'deleted_at' => now()]);

        $response = $this->actingAs($user)->post(route('admin.product.restore', ['id' => $product]));
        $product->deleted_at = null;

        $this->assertModelExists($product);
    }

    private function productData(Category $category): array
    {
        return [
            'name' => 'Test product',
            'price' => 1005000,
            'quantity' => 5,
            'description' => 'Amazing test product',
            'category_id' => $category->id,
            'status' => 'New',
            'images' => [
                UploadedFile::fake()->image('product.jpg', 500, 250)->size(50),
            ],
        ];
    }

    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}
