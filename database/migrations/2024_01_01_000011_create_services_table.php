<?php
// database/migrations/2024_01_01_000011_create_services_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->string('category');
            $table->text('description');
            $table->decimal('location_x', 8, 6);
            $table->decimal('location_y', 8, 6);
            $table->string('icon');
            $table->boolean('available_24h')->default(false);
            $table->json('features');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};