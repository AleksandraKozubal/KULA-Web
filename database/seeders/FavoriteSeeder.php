<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Favorites;
use App\Models\KebabPlace;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Favorites::create([
            "user_id" => User::first()->id,
            "kebab_place_id" => KebabPlace::orderBy("id", "desc")->first()->id,
        ]);
    }
}
