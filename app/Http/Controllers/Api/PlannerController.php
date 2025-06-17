<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlannerItem;
use Illuminate\Http\Request;

class PlannerController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utente non autenticato'
            ], 401);
        }

        try {
            $items = PlannerItem::where('user_id', $user->id)
                ->orderBy('date', 'asc')
                ->orderBy('time', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $items
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nel caricamento del planner',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Admin method to get all planner items
    public function adminIndex()
    {
        try {
            $plannerItems = PlannerItem::with('user')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $plannerItems
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nel caricamento degli elementi del planner',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utente non autenticato'
            ], 401);
        }

        try {
            // Clear existing items for the date
            PlannerItem::where('user_id', $user->id)
                ->where('date', $request->date)
                ->delete();

            // Create new items
            foreach ($request->items as $itemData) {
                $item = PlannerItem::create([
                    'user_id' => $user->id,
                    'date' => $request->date,
                    'item_id' => $itemData['item_id'],
                    'name' => $itemData['name'],
                    'type' => $itemData['type'],
                    'time' => $itemData['time'] ?? null,
                    'notes' => $itemData['notes'] ?? null,
                    'priority' => $itemData['priority'] ?? 'medium',
                    'completed' => $itemData['completed'] ?? false,
                    'original_data' => $itemData['original_data'] ?? null
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Planner salvato con successo'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nel salvataggio del planner',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $item = PlannerItem::where('user_id', $request->user()->id)
                ->findOrFail($id);

            $item->update($request->only([
                'time', 'notes', 'priority', 'completed'
            ]));

            return response()->json([
                'success' => true,
                'data' => $item,
                'message' => 'Elemento aggiornato con successo'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nell\'aggiornamento dell\'elemento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $item = PlannerItem::where('user_id', $request->user()->id)
                ->findOrFail($id);

            $item->delete();

            return response()->json([
                'success' => true,
                'message' => 'Elemento eliminato con successo'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nell\'eliminazione dell\'elemento',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}