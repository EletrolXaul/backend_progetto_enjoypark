<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function index()
    {
        try {
            $ticketTypes = TicketType::orderBy('created_at', 'desc')->get();
            return response()->json([
                'success' => true,
                'data' => $ticketTypes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nel caricamento dei tipi di biglietto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $ticketType = TicketType::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $ticketType
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Tipo di biglietto non trovato',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'required|string|max:100',
                'price' => 'required|numeric|min:0',
                'description' => 'nullable|string',
                'features' => 'nullable|array',
                'is_active' => 'boolean'
            ]);

            $ticketType = TicketType::create($validated);

            return response()->json([
                'success' => true,
                'data' => $ticketType,
                'message' => 'Tipo di biglietto creato con successo'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nella creazione del tipo di biglietto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $ticketType = TicketType::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'type' => 'sometimes|required|string|max:100',
                'price' => 'sometimes|required|numeric|min:0',
                'description' => 'nullable|string',
                'features' => 'nullable|array',
                'is_active' => 'boolean'
            ]);

            $ticketType->update($validated);

            return response()->json([
                'success' => true,
                'data' => $ticketType,
                'message' => 'Tipo di biglietto aggiornato con successo'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nell\'aggiornamento del tipo di biglietto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $ticketType = TicketType::findOrFail($id);
            $ticketType->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tipo di biglietto eliminato con successo'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nell\'eliminazione del tipo di biglietto',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}