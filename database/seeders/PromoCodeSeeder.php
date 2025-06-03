<?php
// database/seeders/PromoCodeSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PromoCode;

class PromoCodeSeeder extends Seeder
{
    public function run()
    {
        $promoCodes = [
            [
                'code' => 'WELCOME10',
                'discount' => 10,
                'type' => 'percentage',
                'description' => 'Sconto 10% per nuovi clienti',
                'min_amount' => 50,
                'max_discount' => 20,
                'valid_until' => '2024-12-31',
                'usage_limit' => 100,
                'used_count' => 23,
            ],
            [
                'code' => 'FAMILY20',
                'discount' => 20,
                'type' => 'fixed',
                'description' => 'Sconto €20 su pacchetti famiglia',
                'min_amount' => 150,
                'max_discount' => null,
                'valid_until' => '2024-06-30',
                'usage_limit' => 50,
                'used_count' => 12,
            ],
            [
                'code' => 'SUMMER15',
                'discount' => 15,
                'type' => 'percentage',
                'description' => 'Sconto estivo 15%',
                'min_amount' => 80,
                'max_discount' => 30,
                'valid_until' => '2024-08-31',
                'usage_limit' => 200,
                'used_count' => 87,
            ],
        ];

        foreach ($promoCodes as $promoCode) {
            PromoCode::create($promoCode);
        }
    }
}