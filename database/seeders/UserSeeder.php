<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\VisitHistory;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Demo User
        $demoUser = User::updateOrCreate(
            ['email' => 'demo@enjoypark.it'],
            [
                'name' => 'Mario Rossi',
                'password' => Hash::make('demo123'),
                'preferences' => [
                    'language' => 'it',
                    'theme' => 'light',
                    'notifications' => true,
                    'newsletter' => true,
                ],
            ]
        );

        // Crea la cronologia delle visite per l'utente demo
        VisitHistory::create([
            'user_id' => $demoUser->id,
            'visit_date' => '2024-01-15',
            'attractions' => ['Dragon Coaster', 'Magic Castle'],
            'rating' => 5,
            'notes' => 'Bellissima giornata al parco!'
        ]);

        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@enjoypark.it'],
            [
                'name' => 'Amministratore',
                'password' => Hash::make('admin'),
                'preferences' => [
                    'language' => 'it',
                    'theme' => 'light',
                    'notifications' => true,
                    'newsletter' => true,
                ],
                'is_admin' => true,
            ]
        );
    }
}
