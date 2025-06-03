<?php
// database/migrations/2024_01_01_000003_create_locations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('category', ['attractions', 'restaurants', 'shops', 'services']);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('icon')->default('📍');
            $table->string('color')->default('#3B82F6');
            $table->json('metadata')->nullable(); // Dati specifici per categoria
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
};