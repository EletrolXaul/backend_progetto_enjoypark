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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:50|unique:promo_codes',
            'description' => 'required|string|max:255',
            'discount' => 'required|numeric|min:0|max:100',
            'type' => 'required|string|in:percentage,fixed',
            'valid_until' => 'required|date|after_or_equal:today', // Cambiato da 'after:today'
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
        $promoCodeData['is_active'] = $request->has('is_active') ? true : false;
        
        $promoCode = PromoCode::create($promoCodeData);
    
        return response()->json(['success' => true, 'promoCode' => $promoCode]);
    }
    
    public function update(Request $request, $id)
    {
        $promoCode = PromoCode::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'code' => 'sometimes|string|max:50|unique:promo_codes,code,' . $id,
            'description' => 'sometimes|string|max:255',
            'discount' => 'sometimes|numeric|min:0|max:100',
            'type' => 'sometimes|string|in:percentage,fixed',
            'valid_until' => 'sometimes|date',
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
        $updateData['is_active'] = $request->has('is_active') ? false : true;
        
        $promoCode->update($updateData);
    
        return response()->json(['success' => true, 'promoCode' => $promoCode]);
    }
    
    public function destroy($id)
    {
        $promoCode = PromoCode::findOrFail($id);
        $promoCode->delete();
    
        return response()->json(['success' => true]);
    }
}