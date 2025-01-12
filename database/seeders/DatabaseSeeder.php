<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Filling;
use App\Models\KebabPlace;
use App\Models\Sauce;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ProductionSeeder::class);

        if (config("app.env") !== "local") {
            return;
        }
        $this->call(UsersSeeder::class);

//        Filling::factory(10)->create();
//        Sauce::factory(10)->create();
//        KebabPlace::factory(10)->create();

        $this->call(CommentSeeder::class);
        $this->call(SuggestionSeeder::class);
        $this->call(FavoriteSeeder::class);
    }
}
