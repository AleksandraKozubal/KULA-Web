<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create("kebab_places", function (Blueprint $table): void {
            $table->id();
            $table->string("name");
            $table->string("image")->nullable();
            $table->string("street");
            $table->string("building_number");
            $table->string("latitude");
            $table->string("longitude");
            $table->string("google_maps_url");
            $table->string("google_maps_rating");
            $table->string("phone");
            $table->string("website")->nullable();
            $table->string("email")->nullable();
            $table->string("opened_at_year")->nullable();
            $table->string("closed_at_year")->nullable();
            $table->json("opening_hours");
            $table->json("fillings")->nullable();
            $table->json("sauces")->nullable();
            $table->string("status");
            $table->boolean("is_craft")->nullable();
            $table->boolean("is_chain_restaurant")->nullable();
            $table->string("location_type");
            $table->json("order_options");
            $table->json("social_media");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("kebab_places");
    }
};
