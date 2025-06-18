<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('show_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('show_id')->constrained()->onDelete('cascade');
            $table->date('booking_date');
            $table->string('time_slot');
            $table->integer('seats_booked')->default(1);
            $table->enum('status', ['confirmed', 'cancelled'])->default('confirmed');
            $table->timestamps();
            
            // Indice per prevenire prenotazioni duplicate nello stesso giorno
            $table->unique(['user_id', 'show_id', 'booking_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('show_bookings');
    }
};