<?php

namespace Database\Seeders;

use App\Models\Filling;
use App\Models\Kebab;
use App\Models\Sauce;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (config("app.env") !== "local") {
            return;
        }

        $this->call(UsersSeeder::class);
        Filling::factory()->count(6)->create();
        Sauce::factory()->count(6)->create();
        Kebab::factory()->count(15)->create();
    }
}
