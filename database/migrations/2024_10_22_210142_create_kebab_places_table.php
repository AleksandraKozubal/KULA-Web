<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kebab_places', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('street');
            $table->string('building_number');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('google_maps_url');
            $table->string('google_maps_rating');
            $table->string('phone');
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('fillings')->nullable();
            $table->string('sauces')->nullable();
            $table->string('opening_hours')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kebab_places');
    }
};
