<?php
// app/Http/Controllers/RestaurantController.php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        return response()->json(Restaurant::all(), 200);
    }

    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response()->json(['message' => 'Ristorante non trovato'], 404);
        }
        return response()->json($restaurant);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'cuisine' => 'nullable|string|max:255',
            'price_range' => 'nullable|string|max:50',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'nullable|string',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'nullable|string',
            'features' => 'nullable|array',
            'opening_hours' => 'nullable|string|max:255',
        ]);

        $restaurant = Restaurant::create($validated);
        return response()->json($restaurant, 201);
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response()->json(['message' => 'Ristorante non trovato'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'cuisine' => 'sometimes|string|max:255',
            'price_range' => 'sometimes|string|max:50',
            'rating' => 'sometimes|numeric|min:0|max:5',
            'description' => 'sometimes|string',
            'location_x' => 'sometimes|numeric',
            'location_y' => 'sometimes|numeric',
            'image' => 'sometimes|string',
            'features' => 'sometimes|array',
            'opening_hours' => 'sometimes|string|max:255',
        ]);

        $restaurant->update($validated);
        return response()->json($restaurant);
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response()->json(['message' => 'Ristorante non trovato'], 404);
        }
        $restaurant->delete();
        return response()->json(['message' => 'Ristorante eliminato con successo']);
    }
}
