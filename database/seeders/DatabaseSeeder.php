<?php

namespace Database\Seeders;

use Database\Seeders\UsersSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (config("app.env") !== "local") {
            return;
        }

        // $this->call(UsersSeeder::class);
    }
}
