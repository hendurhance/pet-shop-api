<?php

namespace Database\Factories;

use App\Enums\HasMarketingEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->unique()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'avatar' => fake()->uuid(),
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model's should be admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => UserTypeEnum::IS_ADMIN,
        ]);
    }

    /**
     * Indicate that the model's should be user.
     */
    public function user(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => UserTypeEnum::IS_USER,
        ]);
    }

    /**
     * Indicate that the model's should have marketing.
     */
    public function marketing(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_marketing' => HasMarketingEnum::HAS_MARKETING,
        ]);
    }
}
