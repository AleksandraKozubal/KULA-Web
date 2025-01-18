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
        Schema::create("suggestions", function (Blueprint $table): void {
            $table->id();
            $table->string("name");
            $table->text("description");
            $table->string("status");
            $table->foreignIdFor(User::class)->constrained()->onDelete("cascade");
            $table->foreignIdFor(KebabPlace::class)->constrained()->onDelete("cascade");
            $table->text("comment")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("suggestions");
    }
};
