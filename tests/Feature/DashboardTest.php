<?php
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function testWithoutUser(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
    }

    public function testWithUser(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/dashboard');

        $response->assertOk();
    }

}
