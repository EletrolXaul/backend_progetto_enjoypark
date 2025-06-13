<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Attraction;
use App\Models\Show;
use App\Models\Restaurant;
use App\Models\Shop;
use App\Models\Service;
use App\Models\Location;
use App\Models\PromoCode;
use App\Models\VisitHistory;
use App\Models\MockCreditCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Recupera i dati da tutti i modelli con paginazione
        $attractions = Attraction::paginate(10);
        $shows = Show::paginate(10);
        $restaurants = Restaurant::paginate(10);
        $shops = Shop::paginate(10);
        
        // Trasforma i dati per la visualizzazione
        $shows->getCollection()->transform(function ($show) {
            if (isset($show->times) && is_array($show->times)) {
                $show->time = implode(", ", $show->times);
            }
            return $show;
        });
        
        $data = [
            'users' => User::paginate(10),
            'orders' => Order::paginate(10),
            'tickets' => Ticket::paginate(10),
            'attractions' => $attractions,
            'shows' => $shows,
            'restaurants' => $restaurants,
            'shops' => $shops,
            'services' => Service::paginate(10),
            'locations' => Location::paginate(10),
            'promoCodes' => PromoCode::paginate(10),
            'visitHistories' => VisitHistory::paginate(10),
            'mockCreditCards' => MockCreditCard::paginate(10),
        ];

        // Aggiunta di statistiche per la dashboard
        $stats = [
            'totalUsers' => User::count(),
            'totalOrders' => Order::count(),
            'totalTickets' => Ticket::count(),
            'totalAttractions' => Attraction::count(),
            'recentOrders' => Order::orderBy('created_at', 'desc')->take(5)->get(),
            'recentUsers' => User::orderBy('created_at', 'desc')->take(5)->get(),
        ];

        return view('dashboard.index', array_merge($data, ['stats' => $stats]));
    }

    // Metodi CRUD per Users
    public function storeUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'membership' => 'required|string|in:standard,premium',
            'is_admin' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'membership' => $request->membership,
            'is_admin' => $request->is_admin ?? false,
            'avatar' => '/placeholder.svg?height=40&width=40',
            'preferences' => [
                'language' => 'it',
                'theme' => 'light',
                'notifications' => true,
                'newsletter' => true,
            ],
        ]);

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'membership' => 'required|string|in:standard,premium',
            'is_admin' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'membership' => $request->membership,
            'is_admin' => $request->is_admin ?? false,
        ]);

        if ($request->password) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        return response()->json(['success' => true, 'user' => $user]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true]);
    }

    // Metodi CRUD per Attractions
    public function storeAttraction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'wait_time' => 'required|integer|min:0',
            'status' => 'required|string|in:open,closed,maintenance',
            'thrill_level' => 'required|integer|min:1|max:5',
            'min_height' => 'required|integer|min:0',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'required|string',
            'features' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $attraction = Attraction::create($request->all());

        return response()->json(['success' => true, 'attraction' => $attraction]);
    }

    public function updateAttraction(Request $request, $id)
    {
        $attraction = Attraction::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'capacity' => 'required|integer|min:1',
            'wait_time' => 'required|integer|min:0',
            'status' => 'required|string|in:open,closed,maintenance',
            'thrill_level' => 'required|integer|min:1|max:5',
            'min_height' => 'required|integer|min:0',
            'location_x' => 'required|numeric',
            'location_y' => 'required|numeric',
            'image' => 'required|string',
            'features' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $attraction->update($request->all());

        return response()->json(['success' => true, 'attraction' => $attraction]);
    }

    public function deleteAttraction($id)
    {
        $attraction = Attraction::findOrFail($id);
        $attraction->delete();

        return response()->json(['success' => true]);
    }

    // Metodi CRUD per Orders
    public function storeOrder(Request $request)
    {
    
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|string|in:pending,confirmed,used,expired',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $orderData = $request->all();
        $orderData['order_number'] = Order::generateOrderNumber();
        $orderData['purchase_date'] = now();
        $orderData['visit_date'] = $request->visit_date ?? now()->addDays(7)->toDateString();
        
        // Fornisci valori predefiniti per i campi JSON
        $orderData['tickets'] = $request->tickets ?? json_encode(['standard' => 1]);
        $orderData['customer_info'] = $request->customer_info ?? json_encode([
            'name' => 'Cliente Dashboard',
            'email' => 'dashboard@example.com',
            'phone' => '1234567890'
        ]);
        $orderData['payment_method'] = $request->payment_method ?? json_encode([
            'type' => 'credit_card',
            'last4' => '1234'
        ]);
        
        // Converti lo stato 'completed' in 'confirmed' e 'cancelled' in 'expired'
        if ($orderData['status'] === 'completed') {
            $orderData['status'] = 'confirmed';
        } else if ($orderData['status'] === 'cancelled') {
            $orderData['status'] = 'expired';
        }
        
        // Rimuovi qr_codes dall'ordine poiché ora ogni biglietto avrà il suo QR code
        $orderData['qr_codes'] = json_encode([]);
        
        $order = Order::create($orderData);
        
        // Crea i biglietti separati per questo ordine
        $this->createTicketsForOrder($order);
    
        return response()->json(['success' => true, 'order' => $order]);
    }
    
    // Nuovo metodo per creare i biglietti
    private function createTicketsForOrder($order)
    {
        $tickets = json_decode($order->tickets, true);
        $ticketPrices = [
            'standard' => 45,
            'adult' => 45,
            'child' => 35,
            'senior' => 40,
            'family' => 160,
            'premium' => 65,
            'season' => 120,
        ];
        
        foreach ($tickets as $type => $quantity) {
            for ($i = 0; $i < $quantity; $i++) {
                // Genera un QR code unico per questo biglietto
                $qrCode = $this->generateUniqueQRCode();
                
                // Mappa lo stato dell'ordine allo stato del biglietto
                $ticketStatus = 'valid';
                if ($order->status === 'expired') {
                    $ticketStatus = 'expired';
                } elseif ($order->status === 'used') {
                    $ticketStatus = 'used';
                } elseif ($order->status === 'cancelled') {
                    $ticketStatus = 'cancelled';
                }
                
                // Crea il record del biglietto
                Ticket::create([
                    'user_id' => $order->user_id,
                    'order_number' => $order->order_number,
                    'visit_date' => $order->visit_date,
                    'ticket_type' => $type,
                    'price' => $ticketPrices[$type] ?? 45, // Prezzo predefinito se non trovato
                    'status' => $ticketStatus,
                    'qr_code' => $qrCode,
                    'metadata' => json_encode([
                        'created_from' => 'dashboard',
                        'order_id' => $order->id
                    ])
                ]);
            }
        }
    }
    
    // Metodo per generare un QR code unico
    private function generateUniqueQRCode()
    {
        $timestamp = now()->timestamp;
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        $qrCode = "EP-{$timestamp}-{$random}";
        
        // Verifica che il QR code sia unico
        while (Ticket::where('qr_code', $qrCode)->exists()) {
            $random = strtoupper(substr(md5(uniqid()), 0, 6));
            $qrCode = "EP-{$timestamp}-{$random}";
        }
        
        return $qrCode;
    }

    public function updateOrder(Request $request, $id)
    {
        
        $order = Order::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|exists:users,id',
            'total_price' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|string|in:pending,confirmed,used,expired',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $updateData = $request->all();
        
        // Converti lo stato 'completed' in 'confirmed' e 'cancelled' in 'expired'
        if (isset($updateData['status'])) {
            if ($updateData['status'] === 'completed') {
                $updateData['status'] = 'confirmed';
            } else if ($updateData['status'] === 'cancelled') {
                $updateData['status'] = 'expired';
            }
            
            // Aggiorna lo stato dei biglietti associati
            $this->updateTicketsStatus($order, $updateData['status']);
        }
        
        $order->update($updateData);
    
        return response()->json(['success' => true, 'order' => $order]);
    }
    
    // Nuovo metodo per aggiornare lo stato dei biglietti
    private function updateTicketsStatus($order, $orderStatus)
    {
        // Mappa lo stato dell'ordine allo stato del biglietto
        $ticketStatus = 'valid';
        if ($orderStatus === 'expired') {
            $ticketStatus = 'expired';
        } elseif ($orderStatus === 'used') {
            $ticketStatus = 'used';
        } elseif ($orderStatus === 'cancelled') {
            $ticketStatus = 'cancelled';
        }
        
        // Aggiorna tutti i biglietti associati a questo ordine
        Ticket::where('order_number', $order->order_number)
              ->update(['status' => $ticketStatus]);
    }

    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
    
        return response()->json(['success' => true]);
    }

    // Implementare metodi simili per gli altri modelli (Orders, Tickets, Shows, ecc.)
    // ...
}