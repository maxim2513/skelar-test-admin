<?php
declare(strict_types=1);

namespace Tests\Feature\Catalog\Catalog;

use App\Models\User;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function testGetPageCreate(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/product');

        $response->assertStatus(200);
    }

    public function testSaveProduct(): void
    {
        $user = User::factory()->create();

        $productTemplate = [
            'name' => fake()->name(),
            'price' => fake()->randomDigit(),
            'description' => fake()->realText(),
        ];
        $response = $this
            ->actingAs($user)
            ->post('/product', $productTemplate);

        $this->assertDatabaseHas('products', $productTemplate);

        $response->assertStatus(302);
    }

    public function testGetPageList(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/products');

        $response->assertStatus(200);
    }
}
