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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'required|string',
            'specialties' => 'nullable|array',
            'opening_hours' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $shop = Shop::create($request->all());

        return response()->json(['success' => true, 'shop' => $shop]);
    }

    public function update(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);

        $validator = Validator::make($request->all(), [
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

        $shop->update($request->all());

        return response()->json(['success' => true, 'shop' => $shop]);
    }

    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return response()->json(['success' => true]);
    }
}
