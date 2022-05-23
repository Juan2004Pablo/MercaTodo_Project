<?php

namespace Tests\Feature\Permission;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_reports(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('report.index'));

        $response->assertForbidden();
    }

    public function test_products_report(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('products.report.index'));

        $response->assertForbidden();
    }

    public function test_dailySales_report(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('dailySales.report.index'));

        $response->assertForbidden();
    }

    public function test_salesByDays_report(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('salesByDays.report.index'));

        $response->assertForbidden();
    }

    public function test_monthlySales_report(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('monthlySales.report.index'));

        $response->assertForbidden();
    }

    public function test_users_report(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('users.report.index'));

        $response->assertForbidden();
    }
}
