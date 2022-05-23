<?php

namespace Tests\Feature\Permission;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
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
