<?php
// app/Http/Controllers/Api/OrderController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all(), 200);
    }

    public function show($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Ordine non trovato'], 404);
        }
        return response()->json($order);
    }

    public function adminIndex()
    {
        $orders = Order::with(['user', 'tickets'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,confirmed,used,expired',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $orderData = $request->all();
        $orderData['order_number'] = Order::generateOrderNumber();
        $orderData['purchase_date'] = now();
        $orderData['visit_date'] = $request->visit_date ?? now()->addDays(7)->toDateString();
        
        // Fornisci valori predefiniti per i campi JSON
        $orderData['tickets'] = $request->tickets ?? json_encode(['standard' => 1]);
        $orderData['customer_info'] = $request->customer_info ?? json_encode([
            'name' => 'Cliente Dashboard',
            'email' => 'dashboard@example.com',
            'phone' => '1234567890'
        ]);
        $orderData['payment_method'] = $request->payment_method ?? json_encode([
            'type' => 'credit_card',
            'last4' => '1234'
        ]);
        
        // Converti lo stato 'completed' in 'confirmed' e 'cancelled' in 'expired'
        if ($orderData['status'] === 'completed') {
            $orderData['status'] = 'confirmed';
        } else if ($orderData['status'] === 'cancelled') {
            $orderData['status'] = 'expired';
        }
        
        // Rimuovi qr_codes dall'ordine poiché ora ogni biglietto avrà il suo QR code
        $orderData['qr_codes'] = json_encode([]);
        
        $order = Order::create($orderData);
        
        // Crea i biglietti separati per questo ordine
        $this->createTicketsForOrder($order);
    
        return response()->json(['success' => true, 'order' => $order]);
    }
    
    // Nuovo metodo per creare i biglietti
    private function createTicketsForOrder($order)
    {
        $tickets = json_decode($order->tickets, true);
        $ticketPrices = [
            'standard' => 45,
            'adult' => 45,
            'child' => 35,
            'senior' => 40,
            'family' => 160,
        ];
        
        foreach ($tickets as $type => $quantity) {
            for ($i = 0; $i < $quantity; $i++) {
                // Genera un QR code unico per questo biglietto
                $qrCode = $this->generateUniqueQRCode();
                
                // Mappa lo stato dell'ordine allo stato del biglietto
                $ticketStatus = 'valid';
                if ($order->status === 'expired') {
                    $ticketStatus = 'expired';
                } elseif ($order->status === 'used') {
                    $ticketStatus = 'used';
                } elseif ($order->status === 'cancelled') {
                    $ticketStatus = 'cancelled';
                }
                
                // Crea il record del biglietto
                Ticket::create([
                    'user_id' => $order->user_id,
                    'order_number' => $order->order_number,
                    'visit_date' => $order->visit_date,
                    'ticket_type' => $type,
                    'price' => $ticketPrices[$type] ?? 45, // Prezzo predefinito se non trovato
                    'status' => $ticketStatus,
                    'qr_code' => $qrCode,
                    'metadata' => json_encode([
                        'created_from' => 'dashboard',
                        'order_id' => $order->id
                    ])
                ]);
            }
        }
    }
    
    // Metodo per generare un QR code unico
    private function generateUniqueQRCode()
    {
        $timestamp = now()->format('YmdHis');
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        $qrCode = "EP-{$timestamp}-{$random}";
        
        // Verifica che il QR code sia unico
        while (Ticket::where('qr_code', $qrCode)->exists()) {
            $random = strtoupper(substr(md5(uniqid()), 0, 6));
            $qrCode = "EP-{$timestamp}-{$random}";
        }
        
        return $qrCode;
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'total_price' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|string|in:pending,confirmed,used,expired',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $updateData = $request->all();
        
        // Converti lo stato 'completed' in 'confirmed' e 'cancelled' in 'expired'
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
    
        return response()->json(['success' => true, 'order' => $order]);
    }
    
    // Nuovo metodo per aggiornare lo stato dei biglietti
    private function updateTicketsStatus($order, $orderStatus)
    {
        // Mappa lo stato dell'ordine allo stato del biglietto
        $ticketStatus = 'valid';
        if ($orderStatus === 'expired') {
            $ticketStatus = 'expired';
        } elseif ($orderStatus === 'used') {
            $ticketStatus = 'used';
        } elseif ($orderStatus === 'cancelled') {
            $ticketStatus = 'cancelled';
        }
        
        // Aggiorna tutti i biglietti associati a questo ordine
        Ticket::where('order_number', $order->order_number)
              ->update(['status' => $ticketStatus]);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    
        return response()->json(['success' => true]);
    }
}