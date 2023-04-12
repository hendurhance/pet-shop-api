<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'path' => $this->faker->imageUrl(640, 480, 'cats', true, 'Faker'),
            'size' => $this->faker->randomNumber(2),
            'type' => $this->faker->mimeType,
        ];
    }
}
