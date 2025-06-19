<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Order;
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

    public function getTicketTypes()
    {
        try {
            $ticketTypes = Ticket::where('is_active', true)
                ->select('id', 'name', 'type', 'price', 'description', 'features')
                ->get()
                ->map(function ($ticket) {
                    return [
                        'id' => $ticket->id,
                        'name' => $ticket->name,
                        'type' => $ticket->type,
                        'price' => $ticket->price,
                        'description' => $ticket->description,
                        'features' => json_decode($ticket->features, true)
                    ];
                });
    
            return response()->json([
                'success' => true,
                'data' => $ticketTypes
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nel recupero dei tipi di biglietti'
            ], 500);
        }
    }

    public function validateQR(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qr_code' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'success' => false, 
                'message' => 'QR Code richiesto'
            ], 422);
        }
    
        $ticket = Ticket::where('qr_code', $request->qr_code)
                       ->with(['order'])
                       ->first();
    
        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code non valido o non trovato'
            ], 404);
        }
    
        // Usa la relazione già caricata invece di cercare separatamente
        $order = $ticket->order;
        
        // Aggiungi il formato camelCase per compatibilità frontend
        if ($order && $order->customer_info) {
            $order->customerInfo = $order->customer_info;
        }
    
        return response()->json([
            'success' => true,
            'ticket' => $ticket,
            'order' => $order,
            'message' => $this->getStatusMessage($ticket->status)
        ]);
    }

    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'qr_code' => 'required|string',
            'status' => 'required|string|in:valid,used,expired,invalid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false, 
                'errors' => $validator->errors()
            ], 422);
        }

        $ticket = Ticket::where('qr_code', $request->qr_code)->first();

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'QR Code non trovato'
            ], 404);
        }

        $ticket->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'ticket' => $ticket,
            'message' => 'Stato aggiornato con successo'
        ]);
    }

    private function getStatusMessage($status)
    {
        return match($status) {
            'valid' => 'Biglietto valido - Accesso consentito',
            'used' => 'Biglietto già utilizzato',
            'expired' => 'Biglietto scaduto',
            'invalid' => 'Biglietto non valido',
            default => 'Stato sconosciuto'
        };
    }
    
    // Aggiungi questo metodo nel TicketController
    public function getUserTickets(Request $request)
    {
        $user = $request->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utente non autenticato'
            ], 401);
        }
        
        try {
            // Recupera tutti i biglietti dell'utente con le informazioni dell'ordine
            $tickets = Ticket::with(['order'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            
            // Raggruppa i biglietti per ordine
            $ticketsByOrder = $tickets->groupBy('order_number')->map(function ($orderTickets) {
                $firstTicket = $orderTickets->first();
                $order = $firstTicket->order;
                
                return [
                    'id' => $order ? $order->id : null,
                    'order_number' => $firstTicket->order_number,
                    'visit_date' => $firstTicket->visit_date,
                    'purchase_date' => $order ? $order->created_at : $firstTicket->created_at,
                    'total_price' => $orderTickets->sum('price'),
                    'status' => $order ? $order->status : 'unknown',
                    'customer_info' => [
                        'name' => $order ? $order->customer_name : $firstTicket->user->name,
                        'email' => $order ? $order->customer_email : $firstTicket->user->email,
                    ],
                    'ticketItems' => $orderTickets->map(function ($ticket) {
                        return [
                            'id' => $ticket->id,
                            'ticket_type' => $ticket->ticket_type,
                            'price' => $ticket->price,
                            'qr_code' => $ticket->qr_code,
                            'status' => $ticket->status,
                            'order_number' => $ticket->order_number
                        ];
                    })->toArray()
                ];
            })->values();
            
            return response()->json($ticketsByOrder);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nel recupero dei biglietti: ' . $e->getMessage()
            ], 500);
        }
    }
}
