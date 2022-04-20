<?php

namespace Tests\Feature\Admin\Product;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_to_the_creation_route(): void
    {
        $user = User::factory()->create(['role'=> 'admin']);
        $response = $this->actingAs($user)->get(route('products.create'));

        $response->assertOk();
    }

    public function test_it_displays_a_product_creation_form(): void
    {
        $user = User::factory()->create(['role'=> 'admin']);
        $response = $this->actingAs($user)->get(route('products.create'));

        $response->assertSee(trans('admin.products.titles.create'));
        $response->assertSee(trans('admin.products.fields.name'));
        $response->assertSee(trans('admin.products.fields.price'));
        $response->assertSee(trans('admin.products.fields.quantity'));
        $response->assertSee(trans('admin.products.fields.images'));
    }
}
