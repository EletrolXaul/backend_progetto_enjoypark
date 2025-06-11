<?php
// app/Http/Controllers/ShowController.php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:shows,slug',
            'description' => 'required|string',
            'venue' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'category' => 'required|string|max:100',
            'times' => 'required|array',
            'capacity' => 'required|integer|min:1',
            'available_seats' => 'required|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'price' => 'required|numeric|min:0',
            'age_restriction' => 'nullable|integer|min:0',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $showData = $request->all();
        $showData['rating'] = $request->rating ?? 0;
        
        $show = Show::create($showData);

        return response()->json(['success' => true, 'show' => $show]);
    }

    public function update(Request $request, $id)
    {
        $show = Show::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:shows,slug,' . $id,
            'description' => 'sometimes|string',
            'venue' => 'sometimes|string|max:255',
            'duration' => 'sometimes|integer|min:1',
            'category' => 'sometimes|string|max:100',
            'times' => 'sometimes|array',
            'capacity' => 'sometimes|integer|min:1',
            'available_seats' => 'sometimes|integer|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'price' => 'sometimes|numeric|min:0',
            'age_restriction' => 'nullable|integer|min:0',
            'location_x' => 'sometimes|numeric',
            'location_y' => 'sometimes|numeric',
            'image' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $show->update($request->all());

        return response()->json(['success' => true, 'show' => $show]);
    }

    public function destroy($id)
    {
        $show = Show::findOrFail($id);
        $show->delete();

        return response()->json(['success' => true]);
    }
}
