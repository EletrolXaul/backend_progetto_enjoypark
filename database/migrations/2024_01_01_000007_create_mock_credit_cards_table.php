<?php
// database/migrations/2024_01_01_000007_create_mock_credit_cards_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mock_credit_cards', function (Blueprint $table) {
            $table->id();
            $table->string('number'); // Numero carta
            $table->string('name'); // Nome identificativo
            $table->string('expiry'); // MM/YY
            $table->string('cvv');
            $table->enum('type', ['visa', 'mastercard', 'amex']);
            $table->enum('result', ['success', 'declined', 'insufficient_funds', 'expired']);
            $table->string('message');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mock_credit_cards');
    }
};