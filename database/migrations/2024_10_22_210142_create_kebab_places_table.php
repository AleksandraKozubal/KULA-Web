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
            $table->string("address");
            $table->string("latitude");
            $table->string("longitude");
            $table->string("place_id")->nullable();
            $table->string("google_maps_rating")->nullable();
            $table->string("phone")->nullable();
            $table->string("website")->nullable();
            $table->string("android")->nullable();
            $table->string("ios")->nullable();
            $table->string("email")->nullable();
            $table->smallInteger("opened_at_year")->nullable();
            $table->smallInteger("closed_at_year")->nullable();
            $table->jsonb("opening_hours_monday")->nullable()->default(json_encode([null, null]));
            $table->jsonb("opening_hours_tuesday")->nullable()->default(json_encode([null, null]));
            $table->jsonb("opening_hours_wednesday")->nullable()->default(json_encode([null, null]));
            $table->jsonb("opening_hours_thursday")->nullable()->default(json_encode([null, null]));
            $table->jsonb("opening_hours_friday")->nullable()->default(json_encode([null, null]));
            $table->jsonb("opening_hours_saturday")->nullable()->default(json_encode([null, null]));
            $table->jsonb("opening_hours_sunday")->nullable()->default(json_encode([null, null]));
            $table->json("fillings")->nullable()->default(json_encode([]));
            $table->json("sauces")->nullable()->default(json_encode([]));
            $table->string("status");
            $table->boolean("is_craft")->nullable();
            $table->boolean("is_chain_restaurant")->nullable();
            $table->string("location_type");
            $table->json("order_options")->default(json_encode([]));
            $table->json("social_media")->default(json_encode([]));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("kebab_places");
    }
};
