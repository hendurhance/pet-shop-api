<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'metadata' => [
                'valid_from' => $this->faker->dateTime->format('Y-m-d H:i:s'),
                'valid_to' => $this->faker->dateTime->format('Y-m-d H:i:s'),
                'image' => File::factory()->create()->uuid,
            ]
        ];
    }
}
