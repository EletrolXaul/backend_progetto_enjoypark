<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlannerItem; // Assumendo che tu abbia questo model

class PlannerController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $date = $request->query('date');
        
        $items = PlannerItem::where('user_id', $user->id)
            ->where('date', $date)
            ->get();
            
        return response()->json($items);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'items' => 'required|array',
            'items.*.id' => 'required|string',
            'items.*.name' => 'required|string',
            'items.*.type' => 'required|in:attraction,show,restaurant,shop,service',
            'items.*.time' => 'nullable|string',
            'items.*.notes' => 'nullable|string',
            'items.*.priority' => 'required|in:low,medium,high',
            'items.*.completed' => 'required|boolean',
            'items.*.originalData' => 'nullable|array'  // Cambiato da original_data a originalData
        ]);
    
        $user = $request->user();
        $date = $request->date;
        
        // Elimina gli items esistenti per questa data
        PlannerItem::where('user_id', $user->id)
            ->where('date', $date)
            ->delete();
        
        // Crea i nuovi items
        $createdItems = [];
        foreach ($request->items as $itemData) {
            $item = PlannerItem::create([
                'user_id' => $user->id,
                'date' => $date,
                'item_id' => $itemData['id'],
                'name' => $itemData['name'],
                'type' => $itemData['type'],
                'time' => $itemData['time'],
                'notes' => $itemData['notes'],
                'priority' => $itemData['priority'],
                'completed' => $itemData['completed'],
                'original_data' => $itemData['originalData'] ?? null  // Mapping corretto
            ]);
            $createdItems[] = $item;
        }
        
        return response()->json($createdItems, 201);
    }
    
    public function update(Request $request, $id)
    {
        $item = PlannerItem::where('user_id', $request->user()->id)
            ->findOrFail($id);
            
        $item->update($request->only(['time', 'notes']));
        
        return response()->json($item);
    }
    
    public function destroy(Request $request, $id)
    {
        $item = PlannerItem::where('user_id', $request->user()->id)
            ->findOrFail($id);
            
        $item->delete();
        
        return response()->json(['message' => 'Item eliminato']);
    }
}