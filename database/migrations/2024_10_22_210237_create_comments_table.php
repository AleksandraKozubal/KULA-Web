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
        Schema::create("comments", function (Blueprint $table): void {
            $table->id();
            $table->string("content");
            $table->foreignIdFor(User::class)->constrained()->onDelete("cascade");
            $table->foreignIdFor(KebabPlace::class)->constrained()->onDelete("cascade");
            $table->foreignId("parent_id")->nullable()->constrained("comments");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("comments");
    }
};
