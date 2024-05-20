<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->word(5, true);
        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'description' => $this->faker->sentence(15),
            'image' => $this->faker->imageUrl(600, 600),
            'price' => $this->faker->randomFloat(1, 1, 499),
            'compare_price' => $this->faker->numberBetween(0, 500, 999),
            'category_id' => Category::inRandomOrder()->first()->id,
            'featured' => $this->faker->boolean(),
            'store_id' => Store::inRandomOrder()->first()->id
        ];
    }
}
