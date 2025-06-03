<?php
// app/Http/Controllers/Api/OrderController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PromoCode;
use App\Models\MockCreditCard;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders()
                         ->orderBy('created_at', 'desc')
                         ->get();
        
        return response()->json($orders);
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
        ]);

        $order->generateQRCodes();

        return response()->json($order, 201);
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
}