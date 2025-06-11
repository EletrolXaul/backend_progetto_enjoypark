<?php
// app/Http/Controllers/ServiceController.php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'icon' => 'required|string',
            'available_24h' => 'boolean',
            'features' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $serviceData = $request->all();
        $serviceData['available_24h'] = $request->has('available_24h') ? true : false;
        
        $service = Service::create($serviceData);

        return response()->json(['success' => true, 'service' => $service]);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'category' => 'sometimes|string|max:100',
            'description' => 'sometimes|string',
            'location_x' => 'sometimes|numeric',
            'location_y' => 'sometimes|numeric',
            'icon' => 'sometimes|string',
            'available_24h' => 'boolean',
            'features' => 'sometimes|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updateData = $request->all();
        $updateData['available_24h'] = $request->has('available_24h') ? true : false;
        
        $service->update($updateData);

        return response()->json(['success' => true, 'service' => $service]);
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json(['success' => true]);
    }
}
