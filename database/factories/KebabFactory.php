<?php

namespace Database\Factories;

use App\Models\Kebab;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Kebab
 */
class KebabFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "logo" => fake()->imageUrl(),
            "address" => fake()->address(),
            "coordinates" => [
                "latitude" => fake()->latitude(),
                "longitude" => fake()->longitude(),
            ],
            "opened_at_year" => fake()->year(),
            "closed_at_year" => fake()->optional()->year(),
            "opening_hours" => [
                "monday" => [
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                "tuesday" => [
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                "wednesday" => [
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                "thursday" => [
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                "friday" => [
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                "saturday" => [
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                "sunday" => [
                    "from" => "10:00",
                    "to" => "22:00",
                ],
            ],
            "fillings" => [
                "chicken",
                "beef",
                "lamb",
            ],
            "sauces" => [
                "garlic",
                "chilli",
                "mayo",
            ],
            "status" => fake()->randomElement(["open", "closed"]),
            "is_craft" => fake()->boolean(),
            "is_chain_restaurant" => fake()->boolean(),
            "location_type" => "restaurant",
            "order_options" => [
                "takeaway",
                "delivery",
            ],
            "social_media" => [
                    "facebook" => fake()->url(),
                    "instagram" => fake()->url(),
                    "twitter" => fake()->url(),
            ],
        ];
    }
}
