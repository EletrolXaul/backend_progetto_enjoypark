<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Demo User
        User::create([
            'name' => 'Mario Rossi',
            'email' => 'demo@enjoypark.it',
            'password' => Hash::make('demo123'),
            'avatar' => '/placeholder.svg?height=40&width=40',
            'preferences' => [
                'language' => 'it',
                'theme' => 'light',
                'notifications' => true,
                'newsletter' => true,
            ],
            'membership' => 'premium',
            'visitHistory' => [
                [
                    'date' => '2024-01-15',
                    'attractions' => ['Dragon Coaster', 'Magic Castle'],
                    'rating' => 5,
                ],
            ],
        ]);

        // Admin User
        User::create([
            'name' => 'Amministratore',
            'email' => 'admin@enjoypark.it',
            'password' => Hash::make('admin'),
            'avatar' => '/placeholder.svg?height=40&width=40',
            'preferences' => [
                'language' => 'it',
                'theme' => 'light',
                'notifications' => true,
                'newsletter' => true,
            ],
            'membership' => 'vip',
            'visitHistory' => [],
            'is_admin' => true,
        ]);
    }
}
