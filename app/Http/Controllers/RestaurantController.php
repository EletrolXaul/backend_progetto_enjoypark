<?php
// app/Http/Controllers/RestaurantController.php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:restaurants,slug',
            'category' => 'required|string|max:100',
            'cuisine' => 'required|string|max:100',
            'price_range' => 'required|string|in:$,$$,$$$',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'required|string',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'required|string',
            'features' => 'required|array',
            'opening_hours' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $restaurantData = $request->all();
        $restaurantData['rating'] = $request->rating ?? 0;
        
        $restaurant = Restaurant::create($restaurantData);

        return response()->json(['success' => true, 'restaurant' => $restaurant]);
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:100',
            'cuisine' => 'sometimes|string|max:100',
            'price_range' => 'sometimes|string|in:$,$$$,$$$$',
            'rating' => 'nullable|numeric|min:0|max:5',
            'description' => 'sometimes|string',
            'location_x' => 'sometimes|numeric',
            'location_y' => 'sometimes|numeric',
            'image' => 'sometimes|string',
            'features' => 'sometimes|array',
            'opening_hours' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $restaurant->update($request->all());

        return response()->json(['success' => true, 'restaurant' => $restaurant]);
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return response()->json(['success' => true]);
    }
}
