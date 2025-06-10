<?php
// database/migrations/2024_01_01_000010_create_shops_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->string('category');
            $table->text('description');
            $table->decimal('location_x', 8, 6);
            $table->decimal('location_y', 8, 6);
            $table->string('image');
            $table->json('specialties');
            $table->string('opening_hours');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shops');

        Schema::table('shops', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};