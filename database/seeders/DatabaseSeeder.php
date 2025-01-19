<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Actions\RetrieveOpinionAction;
use App\Models\Suggestion;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @throws GuzzleException
     */
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
            "kebab_place_id" => 1,
        ]);

        $action = new RetrieveOpinionAction();
        $action->execute();
    }
}
