<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends User
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "email" => fake()->unique()->safeEmail(),
            "email_verified_at" => now(),
            "password" => Hash::make("password"),
            "remember_token" => Str::random(10),
            "active" => true,
            "role" => Role::Admin,
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            "email_verified_at" => null,
        ]);
    }
}
