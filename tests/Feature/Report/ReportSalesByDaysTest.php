<?php

namespace Tests\Feature\Report;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportSalesByDaysTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_sales_by_days_report(): void
    {
        $this->seed();
        $user = $this->user();

        $response = $this->actingAs($user)->get(route('salesByDays.report.index'));

        $response->assertOk();
    }

    public function test_generate_sales_by_days_report(): void
    {
        $this->seed();
        $user = $this->user();
        $category = Category::factory()->create();
        $products = Product::factory(8)->create(['category_id' => $category->id]);

        $response = $this->actingAs($user)->post(route('salesByDays.report.generate', [
            'initialDate' => now(),
            'endDate' => now(),
        ]));

        $response->assertStatus(419);
    }

    private function user(): User
    {
        $user = User::factory()->create();
        $user->assignRole('FullAdmin');

        return $user;
    }
}
