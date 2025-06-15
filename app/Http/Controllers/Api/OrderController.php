<?php
// app/Http/Controllers/Api/OrderController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // Aggiungi questo metodo che manca
    public function getOrdersWithTickets(Request $request)
    {
        try {
            $user = $request->user();

            $orders = Order::where('user_id', $user->id)
                ->with(['user', 'ticketItems'])
                ->orderBy('created_at', 'desc')
                ->get();

            // Aggiungi QR codes a ogni ordine
            $orders->each(function ($order) {
                $order->qr_codes = $order->ticketItems->pluck('qr_code')->toArray();
            });

            return response()->json($orders);
        } catch (\Exception $e) {
            Log::error('Errore nel caricamento ordini con biglietti: ' . $e->getMessage());
            return response()->json(['error' => 'Errore nel caricamento ordini'], 500);
        }
    }

    public function index(Request $request)
    {
        $orders = Order::with(['user', 'ticketItems'])
            ->where('user_id', $request->user()->id)
            ->get();

        // Aggiungi i QR codes a ogni ordine
        $orders->each(function ($order) {
            $order->qr_codes = $order->ticketItems->pluck('qr_code')->toArray();
        });

        return response()->json($orders, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,confirmed,used,expired,completed,cancelled',
            'tickets' => 'required|array',
            'visit_date' => 'sometimes|date|after_or_equal:today',
            'customer_info' => 'sometimes|array',
            'payment_method' => 'sometimes|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $request->user();
        $orderData = $request->all();
        $orderData['order_number'] = Order::generateOrderNumber();
        $orderData['purchase_date'] = now();
        $orderData['visit_date'] = $request->visit_date ?? date('Y-m-d', strtotime('+7 days'));

        // Usa i dati reali dell'utente invece di valori predefiniti
        $orderData['customer_info'] = $request->customer_info ?? [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?? ''
        ];
        $orderData['payment_method'] = $request->payment_method ?? [
            'type' => 'credit_card',
            'last4' => '****'
        ];
        $orderData['qr_codes'] = [];

        // Converti lo stato se necessario
        if ($orderData['status'] === 'completed') {
            $orderData['status'] = 'confirmed';
        } else if ($orderData['status'] === 'cancelled') {
            $orderData['status'] = 'expired';
        }

        $order = Order::create($orderData);

        // Crea i biglietti separati per questo ordine
        $this->createTicketsForOrder($order, $request->tickets);

        // Ricarica l'ordine con i biglietti appena creati
        $order = $order->fresh(['ticketItems', 'user']);

        // Aggiungi i QR codes all'ordine per compatibilità frontend
        $order->qr_codes = $order->ticketItems->pluck('qr_code')->toArray();

        return response()->json(['success' => true, 'order' => $order]);
    }

    private function createTicketsForOrder($order, $ticketsData)
    {
        // Mappa i tipi di biglietti con i prezzi
        $ticketPrices = [
            'standard' => 45,
            'family' => 160,
            'adult' => 45,
            'child' => 35,
            'senior' => 40,
        ];

        foreach ($ticketsData as $ticketData) {
            $type = $ticketData['ticket_type'];
            $quantity = $ticketData['quantity'];

            for ($i = 0; $i < $quantity; $i++) {
                $ticketStatus = $this->mapOrderStatusToTicketStatus($order->status);

                $ticket = Ticket::create([
                    'user_id' => $order->user_id,
                    'order_number' => $order->order_number,
                    'visit_date' => $order->visit_date,
                    'ticket_type' => $type,
                    'price' => $ticketPrices[$type] ?? 45,
                    'status' => $ticketStatus,
                    'qr_code' => $this->generateUniqueQRCode(),
                    'metadata' => [
                        'created_from' => 'frontend',
                        'order_number' => $order->order_number
                    ]
                ]);

                // Debug: verifica che il biglietto sia stato creato
                Log::info('Ticket created:', ['ticket_id' => $ticket->id, 'order_number' => $order->order_number]);
            }
        }
    }

    private function mapOrderStatusToTicketStatus($orderStatus)
    {
        return match ($orderStatus) {
            'expired' => 'expired',
            'used' => 'used',
            'cancelled' => 'cancelled',
            default => 'valid'
        };
    }

    private function generateUniqueQRCode()
    {
        do {
            $qrCode = 'QR_' . Str::random(16) . '_' . time();
        } while (Ticket::where('qr_code', $qrCode)->exists());

        return $qrCode;
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'total_price' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|string|in:pending,confirmed,used,expired,completed,cancelled',
            'visit_date' => 'sometimes|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updateData = $request->all();

        // Converti lo stato se necessario
        if (isset($updateData['status'])) {
            if ($updateData['status'] === 'completed') {
                $updateData['status'] = 'confirmed';
            } else if ($updateData['status'] === 'cancelled') {
                $updateData['status'] = 'expired';
            }

            // Aggiorna lo stato dei biglietti associati
            $this->updateTicketsStatus($order, $updateData['status']);
        }

        $order->update($updateData);

        return response()->json(['success' => true, 'order' => $order->load('ticketItems')]);
    }

    private function updateTicketsStatus($order, $orderStatus)
    {
        $ticketStatus = $this->mapOrderStatusToTicketStatus($orderStatus);

        $order->ticketItems()->update(['status' => $ticketStatus]);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Elimina anche i biglietti associati
        $order->ticketItems()->delete();
        $order->delete();

        return response()->json(['success' => true]);
    }
}
