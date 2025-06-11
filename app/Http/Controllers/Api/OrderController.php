<?php
// app/Http/Controllers/Api/OrderController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\PromoCode;
use App\Models\MockCreditCard;

class OrderController extends Controller
{
    // Lista ordini per utente normale (solo i propri)
    public function index(Request $request)
    {
        $orders = $request->user()->orders()
                         ->orderBy('created_at', 'desc')
                         ->get();
        
        return response()->json($orders);
    }

    // Lista ordini per admin (tutti gli ordini)
    public function adminIndex(Request $request)
    {
        // Questo metodo sarà protetto dal middleware AdminMiddleware
        $orders = Order::with('user')
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        // Trasforma i dati per includere i QR codes dai ticket
        $formattedOrders = $orders->map(function($order) {
            $tickets = Ticket::where('order_number', $order->order_number)->get();
            $qrCodes = $tickets->pluck('qr_code')->toArray();
            
            return [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'userId' => $order->user_id,
                'tickets' => $order->tickets,
                'totalPrice' => $order->total_price,
                'purchaseDate' => $order->purchase_date,
                'visitDate' => $order->visit_date,
                'status' => $order->status,
                'qrCodes' => $qrCodes,
                'customerInfo' => $order->customer_info,
                'paymentMethod' => $order->payment_method,
                'user' => $order->user ? [
                    'name' => $order->user->name,
                    'email' => $order->user->email
                ] : null
            ];
        });
        
        return response()->json($formattedOrders);
    }

    // Aggiorna status ordine (solo admin)
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,used,expired,cancelled'
        ]);
        
        $order->update(['status' => $request->status]);
        
        // Aggiorna anche lo status dei ticket associati se necessario
        if ($request->status === 'used') {
            Ticket::where('order_number', $order->order_number)
                  ->update(['status' => 'used', 'used_at' => now()]);
        }
        
        return response()->json($order);
    }

    // Elimina ordine (admin o proprietario)
    public function destroy(Order $order, Request $request)
    {
        // Verifica autorizzazione (admin o proprietario)
        if (!$request->user()->isAdmin && $order->user_id !== $request->user()->id) {
            return response()->json(['error' => 'Non autorizzato'], 403);
        }
        
        // Elimina i ticket associati
        Ticket::where('order_number', $order->order_number)->delete();
        
        // Elimina l'ordine
        $order->delete();
        
        return response()->json(['message' => 'Ordine eliminato con successo'], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tickets' => 'required|array',
            'visit_date' => 'required|date|after:today',
            'customer_info' => 'required|array',
            'payment_info' => 'required|array',
            'promo_code' => 'nullable|string',
        ]);

        // Validate credit card
        $card = MockCreditCard::validateCard($request->payment_info['number']);
        if (!$card || $card->result !== 'success') {
            return response()->json([
                'error' => $card ? $card->message : 'Carta di credito non valida'
            ], 400);
        }

        // Calculate total
        $total = $this->calculateTotal($request->tickets);
        $discount = 0;

        // Apply promo code if present
        if ($request->promo_code) {
            $promoCode = PromoCode::where('code', $request->promo_code)->first();
            if ($promoCode && $promoCode->isValid($total)) {
                $discount = $promoCode->calculateDiscount($total);
                $promoCode->use();
            }
        }

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'user_id' => $request->user()->id,
            'tickets' => $request->tickets,
            'total_price' => $total - $discount,
            'purchase_date' => now(),
            'visit_date' => $request->visit_date,
            'status' => 'confirmed',
            'customer_info' => $request->customer_info,
            'payment_method' => [
                'last4' => substr($request->payment_info['number'], -4),
                'type' => $card->type,
            ],
            'promo_code' => $request->promo_code,
            'discount_amount' => $discount,
            'qr_codes' => [], // Rimuovi i QR code dall'ordine
        ]);

        // Crea i biglietti separati per questo ordine
        $this->createTicketsForOrder($order, $request->tickets);

        return response()->json($order, 201);
    }
    
    // Nuovo metodo per creare i biglietti
    private function createTicketsForOrder($order, $ticketsData)
    {
        $prices = [
            'standard' => 45,
            'premium' => 65,
            'family' => 160,
            'season' => 120,
            'adult' => 45,
            'child' => 35,
            'senior' => 40,
        ];
        
        foreach ($ticketsData as $type => $quantity) {
            for ($i = 0; $i < $quantity; $i++) {
                // Genera un QR code unico per questo biglietto
                $qrCode = $this->generateUniqueQRCode();
                
                // Crea il record del biglietto
                Ticket::create([
                    'user_id' => $order->user_id,
                    'order_number' => $order->order_number,
                    'visit_date' => $order->visit_date,
                    'ticket_type' => $type,
                    'price' => $prices[$type] ?? 45, // Prezzo predefinito se non trovato
                    'status' => 'valid',
                    'qr_code' => $qrCode,
                    'metadata' => [
                        'created_from' => 'api',
                        'order_id' => $order->id
                    ]
                ]);
            }
        }
    }
    
    // Metodo per generare un QR code unico
    private function generateUniqueQRCode()
    {
        $timestamp = now()->timestamp;
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        $qrCode = "EP-{$timestamp}-{$random}";
        
        // Verifica che il QR code sia unico
        while (Ticket::where('qr_code', $qrCode)->exists()) {
            $random = strtoupper(substr(md5(uniqid()), 0, 6));
            $qrCode = "EP-{$timestamp}-{$random}";
        }
        
        return $qrCode;
    }

    private function calculateTotal($tickets)
    {
        $prices = [
            'standard' => 45,
            'premium' => 65,
            'family' => 160,
            'season' => 120,
        ];

        $total = 0;
        foreach ($tickets as $type => $quantity) {
            $total += ($prices[$type] ?? 0) * $quantity;
        }

        return $total;
    }

    // Nuovo metodo per recuperare gli ordini con i ticket
    public function getOrdersWithTickets(Request $request)
    {
        $user = $request->user();
        $orders = Order::where('user_id', $user->id)
                      ->orderBy('created_at', 'desc')
                      ->get();
        
        // Trasforma i dati per il frontend
        $formattedOrders = $orders->map(function($order) {
            // Recupera i ticket associati a questo ordine
            $tickets = Ticket::where('order_number', $order->order_number)->get();
            
            // Estrai i QR code dai ticket
            $qrCodes = $tickets->pluck('qr_code')->toArray();
            
            return [
                'id' => $order->id,
                'userId' => $order->user_id,
                'tickets' => $order->tickets, // Manteniamo il formato originale per retrocompatibilità
                'totalPrice' => $order->total_price,
                'purchaseDate' => $order->purchase_date,
                'visitDate' => $order->visit_date,
                'status' => $order->status,
                'qrCodes' => $qrCodes, // Usiamo i QR code dai ticket individuali
                'customerInfo' => $order->customer_info,
                'paymentMethod' => $order->payment_method
            ];
        });
        
        return response()->json($formattedOrders);
    }
}