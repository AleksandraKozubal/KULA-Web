<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\KebabPlaceLocationType;
use App\Enums\KebabPlaceStatus;
use App\Models\Filling;
use App\Models\KebabPlace;
use App\Models\Sauce;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends KebabPlace
 */
class KebabPlaceFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "image" => fake()->imageUrl(),
            "address" => fake()->address(),
            "latitude" => fake()->latitude(),
            "longitude" => fake()->longitude(),
            "google_maps_url" => fake()->url(),
            "google_maps_rating" => fake()->randomFloat(1, 1, 5),
            "phone" => fake()->phoneNumber(),
            "website" => fake()->optional()->url(),
            "email" => fake()->optional()->email(),
            "opened_at_year" => fake()->year(),
            "closed_at_year" => fake()->optional()->year(),
            "open_from" => [
                10,10,10,10,10,10,10
            ],
            "open_to" => [
                22,22,22,22,22,22,22
            ],
            "fillings" => fake()->randomElements(Filling::all()->pluck("id"), fake()->numberBetween(1, 3)),
            "sauces" => fake()->randomElements(Sauce::all()->pluck("id"), fake()->numberBetween(0, 5)),
            "status" => fake()->randomElement(array_column(KebabPlaceStatus::cases(), "value")),
            "is_craft" => fake()->boolean(),
            "is_chain_restaurant" => fake()->boolean(),
            "location_type" => fake()->randomElement(array_column(KebabPlaceLocationType::cases(), "value")),
            "order_options" => fake()->randomElement(["phone", "glovo", "pyszne", "uber_eats", "app", "web"]),
            "social_media" => [
                [
                    "name" => "fb",
                    "url" => fake()->url(),
                ],
                [
                    "name" => "ig",
                    "url" => fake()->url(),
                ],
                [
                    "name" => "x",
                    "url" => fake()->url(),
                ],
            ],
        ];
    }
}
