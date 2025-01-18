<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Actions\RetrieveOpinionAction;
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
        $this->call(SuggestionSeeder::class);
        $this->call(FavoriteSeeder::class);

        $action = new RetrieveOpinionAction();
        $action->execute();
    }
}
