<?php
// app/Http/Controllers/Api/TicketController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    // Lista ticket per utente normale (solo i propri)
    public function index(Request $request)
    {
        $user = $request->user();
        $tickets = Ticket::where('user_id', $user->id)->get();
        return response()->json($tickets);
    }

    // Lista ticket per admin (tutti i ticket)
    public function adminIndex(Request $request)
    {
        $tickets = Ticket::with(['user'])
                         ->orderBy('created_at', 'desc')
                         ->get();
        
        return response()->json($tickets);
    }

    // Aggiorna status ticket (solo admin)
    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:valid,used,expired,cancelled'
        ]);
        
        $updateData = ['status' => $request->status];
        
        if ($request->status === 'used') {
            $updateData['used_at'] = now();
        }
        
        $ticket->update($updateData);
        
        return response()->json($ticket);
    }

    // Crea un nuovo ticket
    public function store(Request $request)
    {
        $data = $request->validate([
            'visit_date' => 'required|date|after_or_equal:today',
            'ticket_type' => ['required', Rule::in(['adult', 'child', 'senior', 'family'])],
            'price' => 'required|numeric|min:0',
            'status' => ['sometimes', Rule::in(['valid', 'used', 'expired', 'cancelled'])],
            'metadata' => 'nullable|array',
        ]);

        $data['user_id'] = $request->user()->id;
        $data['order_number'] = uniqid('ORD-');
        $data['qr_code'] = uniqid('QR-');

        $ticket = Ticket::create($data);

        return response()->json($ticket, 201);
    }

    // Mostra un singolo ticket (solo se appartiene all'utente)
    public function show(Request $request, $id)
    {
        $ticket = Ticket::where('user_id', $request->user()->id)->findOrFail($id);
        return response()->json($ticket);
    }

    // Aggiorna un ticket (es. status o metadata)
    public function update(Request $request, $id)
    {
        $ticket = Ticket::where('user_id', $request->user()->id)->findOrFail($id);

        $data = $request->validate([
            'visit_date' => 'sometimes|date|after_or_equal:today',
            'ticket_type' => [Rule::in(['adult', 'child', 'senior', 'family'])],
            'price' => 'sometimes|numeric|min:0',
            'status' => [Rule::in(['valid', 'used', 'expired', 'cancelled'])],
            'used_at' => 'nullable|date',
            'metadata' => 'nullable|array',
        ]);

        $ticket->update($data);

        return response()->json($ticket);
    }

    // Elimina un ticket
    public function destroy(Request $request, $id)
    {
        $ticket = Ticket::where('user_id', $request->user()->id)->findOrFail($id);
        $ticket->delete();

        return response()->json(null, 204);
    }
}
