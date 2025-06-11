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
            'attraction_id' => 'required|integer',
            'time' => 'required|string',
            'notes' => 'nullable|string'
        ]);
        
        $item = PlannerItem::create([
            'user_id' => $request->user()->id,
            'date' => $request->date,
            'attraction_id' => $request->attraction_id,
            'time' => $request->time,
            'notes' => $request->notes
        ]);
        
        return response()->json($item, 201);
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