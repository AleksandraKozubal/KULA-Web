<?php

namespace Database\Seeders;

use App\Models\Kebab;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (config("app.env") !== "local") {
            return;
        }

        $this->call(UsersSeeder::class);
        Kebab::factory()->count(20)->create();
    }
}
