<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    // Lista tutte le locations visibili (per esempio usata pubblicamente)
    public function index(Request $request)
    {
        $query = Location::visible();

        // Se specificato, filtra per categoria
        if ($request->has('category')) {
            $query->byCategory($request->input('category'));
        }

        $locations = $query->get();

        return response()->json($locations);
    }

    // Mostra una singola location, solo se visibile
    public function show($id)
    {
        $location = Location::visible()->findOrFail($id);
        return response()->json($location);
    }

    // Crea una nuova location (protetto da auth)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:attractions,restaurants,shops,services',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'icon' => 'nullable|string|max:10',
            'color' => 'nullable|string|max:7',
            'metadata' => 'nullable|array',
            'is_visible' => 'boolean',
        ]);

        $location = Location::create($validated);

        return response()->json($location, 201);
    }

    // Aggiorna una location (protetto da auth)
    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'sometimes|required|in:attractions,restaurants,shops,services',
            'latitude' => 'sometimes|required|numeric',
            'longitude' => 'sometimes|required|numeric',
            'icon' => 'nullable|string|max:10',
            'color' => 'nullable|string|max:7',
            'metadata' => 'nullable|array',
            'is_visible' => 'boolean',
        ]);

        $location->update($validated);

        return response()->json($location);
    }

    // Cancella una location (protetto da auth)
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return response()->json(['message' => 'Location deleted']);
    }

    // Metodo pubblico personalizzato (opzionale)
    public function public()
    {
        // Potrebbe restituire solo le locations visibili
        $locations = Location::visible()->get();
        return response()->json($locations);
    }
}
