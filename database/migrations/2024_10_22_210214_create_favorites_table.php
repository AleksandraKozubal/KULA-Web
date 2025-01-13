<?php

declare(strict_types=1);

use App\Models\KebabPlace;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("favorites", function (Blueprint $table): void {
            $table->foreignIdFor(User::class)->constrained()->onDelete("cascade");
            $table->foreignIdFor(KebabPlace::class)->constrained()->onDelete("cascade");
            $table->timestamps();
            $table->primary(["user_id", "kebab_place_id"]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("favorites");
    }
};
