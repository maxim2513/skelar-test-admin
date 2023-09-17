<?php
declare(strict_types=1);

namespace Tests\Feature\Catalog\Catalog;

use App\Models\Catalog\Product;
use App\Models\User;
use Database\Factories\Catalog\ProductFactory;
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

    public function testGetPageEdit(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/product/'.$product->id);

        $response->assertStatus(200);
    }

    public function testGetPageEditNotFound(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/product/'.fake()->numberBetween(10));

        $response->assertStatus(404);
    }

    public function testUpdateProduct(): void
    {
        $user = User::factory()->create();

        $productTemplate = [
            'name' => fake()->name(),
            'price' => fake()->numberBetween(1,10**6),
            'description' => fake()->realText(),
        ];

        $product = Product::factory()->create();
        $product->save();

        $response = $this
            ->actingAs($user)
            ->post('/product/'.$product->id, $productTemplate);

        $this->assertDatabaseHas('products', $productTemplate);

        $response->assertStatus(302);
    }
}
