<?php
// app/Http/Controllers/Api/PromoCodeController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PromoCode;

class PromoCodeController extends Controller
{
    public function validate(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ]);

        $promoCode = PromoCode::where('code', $request->code)->first();

        if (!$promoCode) {
            return response()->json(['error' => 'Codice promozionale non trovato'], 404);
        }

        if (!$promoCode->isValid($request->amount)) {
            return response()->json(['error' => 'Codice promozionale non valido o scaduto'], 400);
        }

        $discount = $promoCode->calculateDiscount($request->amount);

        return response()->json([
            'valid' => true,
            'discount' => $discount,
            'description' => $promoCode->description,
        ]);
    }
}