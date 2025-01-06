<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\UsersSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (config("app.env") !== "local") {
            return;
        }
        $this->call(UsersSeeder::class);
        $this->call(KebabPlaceSeeder::class);
        $this->call(SauceSeeder::class);
        $this->call(FillingSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(SuggestionSeeder::class);
        $this->call(FavoriteSeeder::class);

    }
}
