<?php
// database/migrations/2024_01_01_000002_create_attractions_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->integer('wait_time')->default(0);
            $table->enum('status', ['open', 'closed', 'maintenance'])->default('open');
            $table->tinyInteger('thrill_level')->unsigned()->comment('1-5');
            $table->integer('min_height')->comment('cm');
            $table->text('description');
            $table->string('duration');
            $table->integer('capacity');
            $table->decimal('rating', 3, 2)->default(0);
            $table->decimal('location_x', 8, 6);
            $table->decimal('location_y', 8, 6);
            $table->string('image');
            $table->json('features');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};