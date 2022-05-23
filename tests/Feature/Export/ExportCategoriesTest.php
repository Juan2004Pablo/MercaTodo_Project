<?php

namespace Tests\Feature\Export;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;
use App\Models\User;

class ExportCategoriesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_export_categories(): void
    {
        $this->seed();
        $user = $this->user();
        $category = Category::factory(5)->create();

        $response = $this->actingAs($user)->get(route('categories.export'));

        $response->assertOk();
    }

    public function test_export_categories(): void
    {
        $this->seed();
        $user = $this->user();
        $category = Category::factory(5)->create();

        $response = $this->actingAs($user)->get(route('categories.export'));

        $response->assertDownload();
    }

    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}
