<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    public function index()
    {
        return response()->json(Ticket::all(), 200);
    }

    public function show($id)
    {
        $ticket = Ticket::find($id);
        if (!$ticket) {
            return response()->json(['message' => 'Biglietto non trovato'], 404);
        }
        return response()->json($ticket);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'order_number' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'ticket_type' => 'required|string|in:standard,adult,child,senior,family',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string|in:valid,used,expired,cancelled',
            'qr_code' => 'required|string|unique:tickets',
            'metadata' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $ticketData = $request->all();
        $ticketData['metadata'] = $request->metadata ?? [];
        
        $ticket = Ticket::create($ticketData);

        return response()->json(['success' => true, 'ticket' => $ticket]);
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'order_number' => 'sometimes|string|max:255',
            'visit_date' => 'sometimes|date',
            'ticket_type' => 'sometimes|string|in:standard,adult,child,senior,family,premium,season',
            'price' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|string|in:valid,used,expired,cancelled',
            'qr_code' => 'sometimes|string|unique:tickets,qr_code,' . $id,
            'used_at' => 'nullable|date',
            'metadata' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $updateData = $request->all();
        
        // Se lo status viene cambiato in 'used', imposta used_at
        if (isset($updateData['status']) && $updateData['status'] === 'used' && !$ticket->used_at) {
            $updateData['used_at'] = now();
        }
        
        $ticket->update($updateData);

        return response()->json(['success' => true, 'ticket' => $ticket]);
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return response()->json(['success' => true]);
    }

    public function adminIndex()
    {
        $tickets = Ticket::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $tickets
        ], 200);
    }
}
