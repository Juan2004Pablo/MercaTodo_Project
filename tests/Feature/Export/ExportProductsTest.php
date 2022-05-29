<?php

namespace Tests\Feature\Export;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExportProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_export_products(): void
    {
        $this->seed();
        $user = $this->user();
        $category = Category::factory()->create();
        $product = Product::factory(5)->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->get(route('products.export'));

        $response->assertOk();
    }

    public function test_export_products(): void
    {
        $this->seed();
        $user = $this->user();
        $category = Category::factory()->create();
        $product = Product::factory(5)->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->get(route('products.export'));

        $response->assertDownload();
    }

    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}
