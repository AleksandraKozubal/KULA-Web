<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\KebabPlace;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
            "content" => "Świetne jedzenie i szybka obsługa!",
            "user_id" => User::first()->id,
            "kebab_place_id" => KebabPlace::first()->id,
            "parent_id" => null,
        ]);
    }
}
