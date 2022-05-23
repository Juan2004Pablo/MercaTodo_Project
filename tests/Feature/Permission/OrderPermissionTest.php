<?php

namespace Tests\Feature\Permission;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_permission_index_order(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.order'));

        $response->assertForbidden();
    }
}
