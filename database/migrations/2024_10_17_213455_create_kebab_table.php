<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create("kebabs", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("logo");
            $table->string("address");
            $table->json("coordinates");
            $table->string("opened_at_year")->nullable();
            $table->string("closed_at_year")->nullable();
            $table->json("opening_hours");
            $table->json("fillings");
            $table->json("sauces");
            $table->string("status");
            $table->boolean("is_craft");
            $table->boolean("is_chain_restaurant");
            $table->string("location_type");
            $table->json("order_options");
            $table->json("social_media");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists("kebabs");
    }
};
