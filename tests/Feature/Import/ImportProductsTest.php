<?php

namespace Tests\Feature\Import;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImportProductsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_cannot_import_products(): void
    {
        $this->seed();
        $user = $this->user();
        
        $response = $this->actingAs($user)->post(route('products.import', []));

        $response->assertStatus(419);
    }
    
    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}
