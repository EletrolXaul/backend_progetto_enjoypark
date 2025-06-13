<?php
// app/Http/Controllers/ShopController.php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function index()
    {
        return response()->json(Shop::all(), 200);
    }

    public function show($id)
    {
        $shop = Shop::find($id);
        if (!$shop) {
            return response()->json(['message' => 'Negozio non trovato'], 404);
        }
        return response()->json($shop);
    }

    public function store(Request $request)
    {
        // Converti specialties da JSON string ad array se necessario
        $requestData = $request->all();
        
        // Gestisci il campo specialties
        if (isset($requestData['specialties'])) {
            if (is_string($requestData['specialties'])) {
                // Se è una stringa JSON, decodificala
                $decoded = json_decode($requestData['specialties'], true);
                $requestData['specialties'] = $decoded !== null ? $decoded : [];
            }
        } else {
            // Se il campo non esiste, imposta array vuoto
            $requestData['specialties'] = [];
        }
    
        $validator = Validator::make($requestData, [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:shops,slug',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'required|string',
            'specialties' => 'required|array', // Ora sarà sempre un array
            'opening_hours' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $shop = Shop::create($requestData);
    
        return response()->json(['success' => true, 'shop' => $shop]);
    }

    public function update(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);
    
        // Converti specialties da JSON string ad array se necessario
        $requestData = $request->all();
        
        // Gestisci il campo specialties se presente
        if (isset($requestData['specialties'])) {
            if (is_string($requestData['specialties'])) {
                // Se è una stringa JSON, decodificala
                $decoded = json_decode($requestData['specialties'], true);
                $requestData['specialties'] = $decoded !== null ? $decoded : [];
            }
        }
    
        $validator = Validator::make($requestData, [
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:100',
            'description' => 'sometimes|string',
            'location_x' => 'sometimes|numeric',
            'location_y' => 'sometimes|numeric',
            'image' => 'sometimes|string',
            'specialties' => 'sometimes|array',
            'opening_hours' => 'sometimes|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $shop->update($requestData);
    
        return response()->json(['success' => true, 'shop' => $shop]);
    }

    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return response()->json(['success' => true]);
    }
}
