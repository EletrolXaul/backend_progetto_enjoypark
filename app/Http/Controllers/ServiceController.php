<?php
// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json(Service::all(), 200);
    }

    public function show($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servizio non trovato'], 404);
        }
        return response()->json($service);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'icon' => 'nullable|string|max:255',
            'available_24h' => 'nullable|boolean',
            'features' => 'nullable|array',
        ]);

        $service = Service::create($validated);
        return response()->json($service, 201);
    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servizio non trovato'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'location_x' => 'sometimes|numeric',
            'location_y' => 'sometimes|numeric',
            'icon' => 'sometimes|string|max:255',
            'available_24h' => 'sometimes|boolean',
            'features' => 'sometimes|array',
        ]);

        $service->update($validated);
        return response()->json($service);
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['message' => 'Servizio non trovato'], 404);
        }
        $service->delete();
        return response()->json(['message' => 'Servizio eliminato con successo']);
    }
}
