<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("favorites", function (Blueprint $table): void {
            $table->foreignId("user_id")->constrained();
            $table->foreignId("kebab_place_id")->constrained();
            $table->timestamps();
            $table->primary(["user_id", "kebab_place_id"]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("favorites");
    }
};
