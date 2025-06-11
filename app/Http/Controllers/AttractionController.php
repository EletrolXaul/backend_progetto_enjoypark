<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttractionController extends Controller
{
    public function index()
    {
        return response()->json(Attraction::all(), 200);
    }

    public function show($id)
    {
        $attraction = Attraction::find($id);
        if (!$attraction) {
            return response()->json(['message' => 'Attrazione non trovata'], 404);
        }
        return response()->json($attraction);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'wait_time' => 'required|integer|min:0',
            'status' => 'required|string|in:open,closed,maintenance',
            'thrill_level' => 'required|integer|min:1|max:5',
            'min_height' => 'required|integer|min:0',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'required|string',
            'features' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $attraction = Attraction::create($request->all());

        return response()->json(['success' => true, 'attraction' => $attraction]);
    }

    public function update(Request $request, $id)
    {
        $attraction = Attraction::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'wait_time' => 'required|integer|min:0',
            'status' => 'required|string|in:open,closed,maintenance',
            'thrill_level' => 'required|integer|min:1|max:5',
            'min_height' => 'required|integer|min:0',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'required|string',
            'features' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $attraction->update($request->all());

        return response()->json(['success' => true, 'attraction' => $attraction]);
    }

    public function destroy($id)
    {
        $attraction = Attraction::findOrFail($id);
        $attraction->delete();

        return response()->json(['success' => true]);
    }
}
