<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Suggestion;
use App\Models\User;
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
        $this->call(CommentSeeder::class);
        $this->call(FavoriteSeeder::class);

        Suggestion::factory(10)->create([
//            "user_id" => User::factory(),
            "kebab_place_id" => 1,
        ]);
    }
}
