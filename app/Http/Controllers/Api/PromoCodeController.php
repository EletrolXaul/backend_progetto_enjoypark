<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromoCodeController extends Controller
{
    public function index()
    {
        return response()->json(PromoCode::all(), 200);
    }

    public function show($id)
    {
        $promoCode = PromoCode::find($id);
        if (!$promoCode) {
            return response()->json(['message' => 'Codice promozionale non trovato'], 404);
        }
        return response()->json($promoCode);
    }

    public function adminIndex()
    {
        try {
            $promoCodes = PromoCode::orderBy('created_at', 'desc')->get();
            return response()->json([
                'success' => true,
                'data' => $promoCodes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nel caricamento dei codici promozionali'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50|unique:promo_codes',
            'description' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0|max:100',
            'type' => 'required|string|in:percentage,fixed',
            'valid_until' => 'required|date|after_or_equal:today',
            'min_amount' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $promoCodeData = $request->all();
        $promoCodeData['used_count'] = 0;
        // Correzione: usa il valore effettivo del campo, non has()
        $promoCodeData['is_active'] = $request->input('is_active', true);
        
        $promoCode = PromoCode::create($promoCodeData);
    
        return response()->json(['success' => true, 'promoCode' => $promoCode]);
    }
    
    public function update(Request $request, $id)
    {
        $promoCode = PromoCode::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50|unique:promo_codes,code,' . $id,
            'description' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0|max:100',
            'type' => 'required|string|in:percentage,fixed',
            'valid_until' => 'required|date|after_or_equal:today',
            'min_amount' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'used_count' => 'sometimes|integer|min:0',
            'is_active' => 'boolean',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $updateData = $request->all();
        // Correzione: usa il valore effettivo del campo, non has()
        $updateData['is_active'] = $request->input('is_active', $promoCode->is_active);
        
        $promoCode->update($updateData);
    
        return response()->json(['success' => true, 'promoCode' => $promoCode]);
    }
    
    public function destroy($id)
    {
        $promoCode = PromoCode::findOrFail($id);
        $promoCode->delete();
    
        return response()->json(['success' => true]);
    }

    /**
     * Valida un codice promozionale
     */
    public function validatePromo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'order_amount' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dati non validi',
                'errors' => $validator->errors()
            ], 422);
        }

        $code = strtoupper(trim($request->code));
        $orderAmount = $request->order_amount;

        // Trova il codice promozionale
        $promoCode = PromoCode::where('code', $code)
            ->where('is_active', true)
            ->where('valid_until', '>=', now())
            ->first();

        if (!$promoCode) {
            return response()->json([
                'success' => false,
                'message' => 'Codice promozionale non valido o scaduto'
            ], 404);
        }

        // Verifica l'importo minimo
        if ($promoCode->min_amount && $orderAmount < $promoCode->min_amount) {
            return response()->json([
                'success' => false,
                'message' => "Importo minimo richiesto: €{$promoCode->min_amount}"
            ], 400);
        }

        // Verifica il limite di utilizzo
        if ($promoCode->usage_limit && $promoCode->used_count >= $promoCode->usage_limit) {
            return response()->json([
                'success' => false,
                'message' => 'Codice promozionale esaurito'
            ], 400);
        }

        // Calcola lo sconto
        $discountAmount = 0;
        if ($promoCode->type === 'percentage') {
            $discountAmount = ($orderAmount * $promoCode->discount) / 100;
            // Applica il limite massimo se presente
            if ($promoCode->max_discount && $discountAmount > $promoCode->max_discount) {
                $discountAmount = $promoCode->max_discount;
            }
        } else {
            $discountAmount = $promoCode->discount;
        }

        // Assicurati che lo sconto non superi l'importo dell'ordine
        $discountAmount = min($discountAmount, $orderAmount);

        return response()->json([
            'success' => true,
            'message' => 'Codice promozionale applicato con successo',
            'data' => [
                'code' => $promoCode->code,
                'description' => $promoCode->description,
                'discount_amount' => round($discountAmount, 2),
                'type' => $promoCode->type,
                'discount_value' => $promoCode->discount,
                'new_total' => round($orderAmount - $discountAmount, 2)
            ]
        ]);
    }
}