<?php
// database/seeders/OrderSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            [
                'order_number' => 'ORDER-1703123456789',
                'user_id' => 1, // Mario Rossi
                'tickets' => ['standard' => 2, 'premium' => 1],
                'total_price' => 155.00,
                'purchase_date' => '2024-01-15 10:30:00',
                'visit_date' => '2024-02-14',
                'status' => 'confirmed',
                'qr_codes' => ['EP-1703123456789-ABC123', 'EP-1703123456790-DEF456', 'EP-1703123456791-GHI789'],
                'customer_info' => [
                    'name' => 'Mario Rossi',
                    'email' => 'mario.rossi@email.com',
                    'phone' => '+39 123 456 7890',
                ],
                'payment_method' => [
                    'last4' => '1111',
                    'type' => 'visa',
                ],
            ],
            [
                'order_number' => 'ORDER-1703123456792',
                'user_id' => 1,
                'tickets' => ['season' => 1],
                'total_price' => 120.00,
                'purchase_date' => '2024-01-20 16:45:00',
                'visit_date' => '2024-03-01',
                'status' => 'confirmed',
                'qr_codes' => ['EP-1703123456798-BCD890'],
                'customer_info' => [
                    'name' => 'Mario Rossi',
                    'email' => 'mario.rossi@email.com',
                    'phone' => '+39 123 456 7890',
                ],
                'payment_method' => [
                    'last4' => '1111',
                    'type' => 'visa',
                ],
            ],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}