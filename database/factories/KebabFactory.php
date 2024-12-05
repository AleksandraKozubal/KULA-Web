<?php

namespace Database\Factories;

use App\Models\Filling;
use App\Models\Kebab;
use App\Models\Sauce;
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
            "lat" => fake()->latitude(),
            "long" => fake()->longitude(),
            "opened_at_year" => fake()->year(),
            "closed_at_year" => fake()->optional()->year(),
            "opening_hours" => [
                [
                    "day" => "poniedziałek",
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                [
                    "day" => "wtorek",
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                [
                    "day" => "środa",
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                [
                    "day" => "czwartek",
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                [
                    "day" => "piątek",
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                [
                    "day" => "sobota",
                    "from" => "10:00",
                    "to" => "22:00",
                ],
                [
                    "day" => "niedziela",
                    "from" => "10:00",
                    "to" => "22:00",
                ]
            ],
            "fillings" => fake()->randomElements(Filling::all()->pluck("id"), fake()->numberBetween(1, 3)),
            "sauces" => fake()->randomElements(Sauce::all()->pluck("id"), fake()->numberBetween(0, 5)),
            "status" => fake()->randomElement(["open", "closed"]),
            "is_craft" => fake()->boolean(),
            "is_chain_restaurant" => fake()->boolean(),
            "location_type" => fake()->randomElement(["dine-in", "food stand"]),
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
