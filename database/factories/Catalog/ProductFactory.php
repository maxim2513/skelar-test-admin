<?php
declare(strict_types=1);

namespace Database\Factories\Catalog;

use App\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(1,10**6),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
