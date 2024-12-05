<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Sauce;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sauce>
 */
class SauceFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => fake()->word,
        ];
    }
}
