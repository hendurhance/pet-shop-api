<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\File;
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
        $categories = Category::all()->pluck('uuid')->toArray();
        $files = File::all()->pluck('uuid')->toArray();
        $brands = Brand::all()->pluck('uuid')->toArray();

        return [
            'category_uuid' => $this->faker->randomElement($categories),
            'title' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 50, 500),
            'description' => $this->faker->text,
            'metadata' => [
                'brand' => $this->faker->randomElement($brands),
                'image' => $this->faker->randomElement($files),
            ]
        ];
    }
}
