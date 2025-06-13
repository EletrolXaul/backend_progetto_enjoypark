<?php
// app/Http/Controllers/ShowController.php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index()
    {
        return response()->json(Show::all(), 200);
    }

    public function show($id)
    {
        $show = Show::find($id);
        if (!$show) {
            return response()->json(['message' => 'Spettacolo non trovato'], 404);
        }
        return response()->json($show);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'venue' => 'nullable|string|max:255',
            'duration' => 'nullable|integer|min:0',
            'category' => 'nullable|string|max:255',
            'times' => 'nullable|array',
            'capacity' => 'nullable|integer|min:0',
            'available_seats' => 'nullable|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'price' => 'nullable|numeric|min:0',
            'age_restriction' => 'nullable|integer|min:0',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'nullable|string',
        ]);

        $show = Show::create($validated);
        return response()->json($show, 201);
    }

    public function update(Request $request, $id)
    {
        $show = Show::find($id);
        if (!$show) {
            return response()->json(['message' => 'Spettacolo non trovato'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'venue' => 'sometimes|string|max:255',
            'duration' => 'sometimes|integer|min:0',
            'category' => 'sometimes|string|max:255',
            'times' => 'sometimes|array',
            'capacity' => 'sometimes|integer|min:0',
            'available_seats' => 'sometimes|integer|min:0',
            'rating' => 'sometimes|numeric|min:0|max:5',
            'price' => 'sometimes|numeric|min:0',
            'age_restriction' => 'sometimes|integer|min:0',
            'location_x' => 'sometimes|numeric',
            'location_y' => 'sometimes|numeric',
            'image' => 'sometimes|string',
        ]);

        $show->update($validated);
        return response()->json($show);
    }

    public function destroy($id)
    {
        $show = Show::find($id);
        if (!$show) {
            return response()->json(['message' => 'Spettacolo non trovato'], 404);
        }
        $show->delete();
        return response()->json(['message' => 'Spettacolo eliminato con successo']);
    }
}
