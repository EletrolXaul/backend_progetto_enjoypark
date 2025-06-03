<?php
// database/migrations/2024_01_01_000005_create_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // ORDER-1703123456789
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('tickets'); // {"standard": 2, "premium": 1}
            $table->decimal('total_price', 8, 2);
            $table->timestamp('purchase_date');
            $table->date('visit_date');
            $table->enum('status', ['pending', 'confirmed', 'used', 'expired'])->default('pending');
            $table->json('qr_codes'); // Array di QR codes
            $table->json('customer_info'); // Nome, email, telefono
            $table->json('payment_method'); // last4, type
            $table->string('promo_code')->nullable();
            $table->decimal('discount_amount', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};