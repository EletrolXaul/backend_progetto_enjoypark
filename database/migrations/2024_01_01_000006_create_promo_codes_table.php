<?php
// database/migrations/2024_01_01_000006_create_promo_codes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('discount', 8, 2);
            $table->enum('type', ['percentage', 'fixed']);
            $table->text('description');
            $table->decimal('min_amount', 8, 2)->default(0);
            $table->decimal('max_discount', 8, 2)->nullable(); // Solo per percentage
            $table->date('valid_until');
            $table->integer('usage_limit')->default(0); // 0 = unlimited
            $table->integer('used_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('promo_codes');
    }
};