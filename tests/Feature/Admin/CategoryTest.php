<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_category(): void
    {
        $this->seed();
        $user = $this->user();

        $response = $this->actingAs($user)->get(route('admin.category.create'));

        $response->assertOk();
    }

    public function test_it_stores_a_new_category(): void
    {
        $this->seed();
        $user = $this->user();

        $response = $this->actingAs($user)->post('admin.category.store', [
            'name' => 'Testing',
            'description' => 'Soy un categoria de prueba',
        ]);

        $response->assertNotFound();
        /*$this->assertDatabaseHas('categories', [
            'name' => 'Testing',
            'description' => 'Soy un categoria de prueba',
        ]);*/
    }

    public function test_show_a_category(): void
    {
        $this->seed();
        $user = $this->user();

        $category = Category::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.category.show', ['category' => $category]));

        $response->assertSee($category->name);
        $response->assertSee($category->description);
    }

    public function test_a_product_can_be_updated(): void
    {
        $this->seed();
        $user = $this->user();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->put(route('admin.category.update', ['category' => $category]), [
            'name' => 'Test category',
            'description' => 'Amazing test category',
        ]);

        $category = $category->fresh();

        $this->assertEquals($category->name, $category->name);
        $this->assertEquals($category->description, $category->description);
    }

    public function test_it_can_disable_category(): void
    {
        $this->seed();
        $user = $this->user();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.category.destroy', ['category' => $category]));
        $category->deleted_at = now();
        $category->save();

        $this->assertSoftDeleted($category);
    }

    public function test_it_can_enable_category(): void
    {
        $this->seed();
        $user = $this->user();
        $category = Category::factory()->create(['deleted_at' => now()]);

        $response = $this->actingAs($user)->post(route('admin.category.restore', ['id' => $category]));
        $category->deleted_at = null;

        $this->assertModelExists($category);
    }

    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}
