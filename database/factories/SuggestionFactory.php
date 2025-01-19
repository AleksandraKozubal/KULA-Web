<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\SuggestionStatus;
use App\Models\Suggestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Suggestion>
 */
class SuggestionFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => fake()->sentence,
            "description" => fake()->paragraph,
            "status" => fake()->randomElement(SuggestionStatus::cases()),
            "user_id" => 1,
            "kebab_place_id" => 1,
            "comment" => null,
        ];
    }
}
