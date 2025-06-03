<?php
// app/Http/Controllers/AttractionController.php

namespace App\Http\Controllers;

use App\Models\Attraction;
use Illuminate\Http\Request;

class AttractionController extends Controller
{
    // Lista tutte le attrazioni
    public function index()
    {
        return response()->json(Attraction::all(), 200);
    }

    // Mostra una singola attrazione
    public function show($id)
    {
        $attraction = Attraction::find($id);
        if (!$attraction) {
            return response()->json(['message' => 'Attrazione non trovata'], 404);
        }
        return response()->json($attraction);
    }

    // Crea una nuova attrazione
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'wait_time' => 'nullable|integer|min:0',
            'status' => 'required|string|in:open,closed,maintenance',
            'thrill_level' => 'nullable|string|max:100',
            'min_height' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer|min:0',
            'capacity' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'nullable|string',
            'features' => 'nullable|array'
        ]);

        $attraction = Attraction::create($validated);
        return response()->json($attraction, 201);
    }

    // Aggiorna un'attrazione esistente
    public function update(Request $request, $id)
    {
        $attraction = Attraction::find($id);
        if (!$attraction) {
            return response()->json(['message' => 'Attrazione non trovata'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'wait_time' => 'sometimes|integer|min:0',
            'status' => 'sometimes|string|in:open,closed,maintenance',
            'thrill_level' => 'sometimes|string|max:100',
            'min_height' => 'sometimes|integer|min:0',
            'description' => 'sometimes|string',
            'duration' => 'sometimes|integer|min:0',
            'capacity' => 'sometimes|integer|min:0',
            'rating' => 'sometimes|numeric|min:0|max:5',
            'location_x' => 'sometimes|numeric',
            'location_y' => 'sometimes|numeric',
            'image' => 'sometimes|string',
            'features' => 'sometimes|array'
        ]);

        $attraction->update($validated);
        return response()->json($attraction);
    }

    // Elimina un'attrazione
    public function destroy($id)
    {
        $attraction = Attraction::find($id);
        if (!$attraction) {
            return response()->json(['message' => 'Attrazione non trovata'], 404);
        }

        $attraction->delete();
        return response()->json(['message' => 'Attrazione eliminata con successo']);
    }
}
