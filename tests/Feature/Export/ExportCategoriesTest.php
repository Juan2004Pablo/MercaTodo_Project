<?php

namespace Tests\Feature\Export;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
