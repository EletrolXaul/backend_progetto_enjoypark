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

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::with(['user', 'ticketItems'])->get(), 200);
    }

    public function show($id)
    {
        $order = Order::with(['user', 'ticketItems.ticketType'])->find($id);
        if (!$order) {
            return response()->json(['message' => 'Ordine non trovato'], 404);
        }
        return response()->json($order);
    }

    public function adminIndex()
    {
        $orders = Order::with(['user', 'ticketItems.ticketType'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'user_id' => $order->user_id,
                    'user_name' => $order->user ? $order->user->name : 'N/A',
                    'total_price' => $order->total_price,
                    'status' => $order->status,
                    'created_at' => $order->created_at,
                ];
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
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $orderData = $request->all();
        $orderData['order_number'] = Order::generateOrderNumber();
        $orderData['purchase_date'] = now();
        $orderData['visit_date'] = $request->visit_date ?? date('Y-m-d', strtotime('+7 days'));
        
        // Fornisci valori predefiniti per i campi JSON
        $orderData['customer_info'] = $request->customer_info ?? [
            'name' => 'Cliente Dashboard',
            'email' => 'dashboard@example.com',
            'phone' => '1234567890'
        ];
        $orderData['payment_method'] = $request->payment_method ?? [
            'type' => 'credit_card',
            'last4' => '1234'
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
    
        return response()->json(['success' => true, 'order' => $order->load('ticketItems')]);
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
                
                Ticket::create([
                    'user_id' => $order->user_id,
                    'order_number' => $order->order_number, // Usa order_number invece di order_id
                    'visit_date' => $order->visit_date,
                    'ticket_type' => $type, // Usa ticket_type direttamente
                    'price' => $ticketPrices[$type] ?? 45,
                    'status' => $ticketStatus,
                    'qr_code' => $this->generateUniqueQRCode(),
                    'metadata' => [
                        'created_from' => 'frontend',
                        'order_number' => $order->order_number // Salva order_number nei metadata
                    ]
                ]);
            }
        }
    }
    
    private function mapOrderStatusToTicketStatus($orderStatus)
    {
        return match($orderStatus) {
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