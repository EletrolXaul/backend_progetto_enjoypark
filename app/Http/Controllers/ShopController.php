<?php
// app/Http/Controllers/ShopController.php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'nullable|string',
            'specialties' => 'nullable|array',
            'opening_hours' => 'nullable|string|max:255',
        ]);

        $shop = Shop::create($validated);
        return response()->json($shop, 201);
    }

    public function update(Request $request, $id)
    {
        $shop = Shop::find($id);
        if (!$shop) {
            return response()->json(['message' => 'Negozio non trovato'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'location_x' => 'sometimes|numeric',
            'location_y' => 'sometimes|numeric',
            'image' => 'sometimes|string',
            'specialties' => 'sometimes|array',
            'opening_hours' => 'sometimes|string|max:255',
        ]);

        $shop->update($validated);
        return response()->json($shop);
    }

    public function destroy($id)
    {
        $shop = Shop::find($id);
        if (!$shop) {
            return response()->json(['message' => 'Negozio non trovato'], 404);
        }
        $shop->delete();
        return response()->json(['message' => 'Negozio eliminato con successo']);
    }
}
