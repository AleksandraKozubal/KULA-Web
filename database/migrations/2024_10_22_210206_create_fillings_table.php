<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("fillings", function (Blueprint $table): void {
            $table->id();
            $table->string("name");
            $table->boolean("is_vegan");
            $table->string("hex_color");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("fillings");
    }
};
