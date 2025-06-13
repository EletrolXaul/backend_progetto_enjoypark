<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketType;
use Illuminate\Support\Str;

class TicketSeeder extends Seeder
{
    public function run()
    {
        // Assicurati che esistano utenti e tipi di biglietto
        $user = User::first();
        $ticketTypes = TicketType::all();
        
        if (!$user) {
            $this->command->info('Skipping TicketSeeder: No users found');
            return;
        }
        
        if ($ticketTypes->isEmpty()) {
            $this->command->info('Skipping TicketSeeder: No ticket types found');
            return;
        }

        $tickets = [];
        
        // Crea alcuni biglietti di esempio
        foreach ($ticketTypes->take(3) as $index => $ticketType) {
            $tickets[] = [
                'user_id' => $user->id,
                'order_number' => 'ORDER-' . (time() + $index) . sprintf('%03d', $index + 1),
                'visit_date' => now()->addDays(7 + $index)->toDateString(),
                'ticket_type_id' => $ticketType->id,
                'price' => $ticketType->price,
                'status' => 'valid',
                'qr_code' => 'QR_' . Str::random(16) . '_' . (time() + $index),
                'metadata' => [
                    'created_from' => 'seeder',
                    'ticket_type_name' => $ticketType->name,
                    'notes' => 'Biglietto di esempio per ' . $ticketType->name
                ]
            ];
        }

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
        
        $this->command->info('Created ' . count($tickets) . ' sample tickets');
    }
}
