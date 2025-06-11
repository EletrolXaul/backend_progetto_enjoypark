<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('planner_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->string('item_id'); // ID univoco dell'item nel planner
            $table->string('name');
            $table->enum('type', ['attraction', 'show', 'restaurant', 'shop', 'service']);
            $table->time('time')->nullable();
            $table->text('notes')->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->boolean('completed')->default(false);
            $table->json('original_data')->nullable(); // Dati originali della struttura
            $table->timestamps();
            
            // Indici per migliorare le performance
            $table->index(['user_id', 'date']);
            $table->unique(['user_id', 'date', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planner_items');
    }
};
