<?php
// database/migrations/2024_01_01_000004_create_tickets_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('order_number');
            $table->date('visit_date');
            $table->enum('ticket_type', ['adult', 'child', 'senior', 'family', 'standard', 'premium']);
            $table->decimal('price', 8, 2);
            $table->enum('status', ['valid', 'used', 'expired', 'cancelled'])->default('valid');
            $table->string('qr_code')->unique();
            $table->timestamp('used_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index('order_number');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};

Schema::create('tickets', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('order_number');
    $table->date('visit_date');
    $table->foreignId('ticket_type_id')->constrained('ticket_types')->onDelete('cascade'); // Cambiato da enum a foreign key
    $table->decimal('price', 8, 2);
    $table->enum('status', ['valid', 'used', 'expired', 'cancelled'])->default('valid');
    $table->string('qr_code')->unique();
    $table->timestamp('used_at')->nullable();
    $table->json('metadata')->nullable();
    $table->timestamps();
    
    $table->index('order_number');
});