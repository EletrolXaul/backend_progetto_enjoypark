<?php
// database/migrations/2024_01_01_000008_create_shows_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->text('description');
            $table->string('venue');
            $table->string('duration');
            $table->string('category');
            $table->json('times'); // Array di orari
            $table->integer('capacity');
            $table->integer('available_seats');
            $table->decimal('rating', 3, 2)->default(0);
            $table->decimal('price', 8, 2);
            $table->string('age_restriction');
            $table->decimal('location_x', 8, 6);
            $table->decimal('location_y', 8, 6);
            $table->string('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shows');

        Schema::table('shows', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};