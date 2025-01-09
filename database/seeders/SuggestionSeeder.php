<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\KebabPlace;
use App\Models\Suggestion;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuggestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Suggestion::create(["name" => "Więcej wegańskich opcji", "description" => "Dodanie większej liczby wegańskich nadzień i sosów.", "status" => "pending", "user_id" => User::first()->id, "kebab_place_id" => KebabPlace::first()->id]);
    }
}
