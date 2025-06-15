<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketType;
use App\Models\Order;
use Illuminate\Support\Str;

class TicketSeeder extends Seeder
{
    public function run()
    {
        // Assicurati che esistano utenti, ordini e tipi di biglietto
        $user = User::first();
        $orders = Order::all();
        $ticketTypes = TicketType::all();
        
        if (!$user) {
            $this->command->info('Skipping TicketSeeder: No users found');
            return;
        }
        
        if ($orders->isEmpty()) {
            $this->command->info('Skipping TicketSeeder: No orders found');
            return;
        }
        
        if ($ticketTypes->isEmpty()) {
            $this->command->info('Skipping TicketSeeder: No ticket types found');
            return;
        }

        // Crea ticket per ogni ordine esistente
        foreach ($orders as $order) {
            $qrCodes = $order->qr_codes ?? [];
            $ticketsData = $order->tickets ?? [];
            
            $qrIndex = 0;
            foreach ($ticketsData as $ticketTypeName => $quantity) {
                // Trova il tipo di biglietto corrispondente
                $ticketType = $ticketTypes->where('name', $ticketTypeName)->first() 
                           ?? $ticketTypes->first();
                
                for ($i = 0; $i < $quantity; $i++) {
                    $qrCode = $qrCodes[$qrIndex] ?? 'QR_' . Str::random(16) . '_' . time();
                    
                    Ticket::create([
                        'user_id' => $order->user_id,
                        'order_number' => $order->order_number,
                        'visit_date' => $order->visit_date,
                        'ticket_type_id' => $ticketType->id,
                        'price' => $ticketType->price,
                        'status' => 'valid',
                        'qr_code' => $qrCode,
                        'metadata' => [
                            'created_from' => 'seeder',
                            'ticket_type_name' => $ticketType->name,
                            'order_id' => $order->id
                        ]
                    ]);
                    
                    $qrIndex++;
                }
            }
        }
        
        $this->command->info('Tickets created successfully!');
    }
}
