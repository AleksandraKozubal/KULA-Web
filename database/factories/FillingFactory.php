<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Filling;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Filling>
 */
class FillingFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => fake()->word,
        ];
    }
}