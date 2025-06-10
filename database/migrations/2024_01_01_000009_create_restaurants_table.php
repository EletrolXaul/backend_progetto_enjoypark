<?php
// database/migrations/2024_01_01_000009_create_restaurants_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->string('category');
            $table->string('cuisine');
            $table->enum('price_range', ['$', '$$', '$$$']);
            $table->decimal('rating', 3, 2)->default(0);
            $table->text('description');
            $table->decimal('location_x', 8, 6);
            $table->decimal('location_y', 8, 6);
            $table->string('image');
            $table->json('features');
            $table->string('opening_hours');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurants');

        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};