<?php
// database/migrations/2024_01_01_000001_create_visit_histories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visit_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('visit_date');
            $table->json('attractions'); // Array delle attrazioni visitate
            $table->integer('rating')->min(1)->max(5);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visit_histories');
    }
};