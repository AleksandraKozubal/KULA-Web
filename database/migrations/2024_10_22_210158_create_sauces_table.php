<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sauces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('spiciness');
            $table->string('is_vegan');
            $table->string('is_gluten_free');
            $table->string('hex_color');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sauces');
    }
};
