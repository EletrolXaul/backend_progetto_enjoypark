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
        $data = [
            'users' => User::paginate(10),
            'orders' => Order::paginate(10),
            'tickets' => Ticket::paginate(10),
            'attractions' => Attraction::paginate(10),
            'shows' => Show::paginate(10),
            'restaurants' => Restaurant::paginate(10),
            'shops' => Shop::paginate(10),
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
            'wait_time' => 'required|integer|min:0',
            'status' => 'required|string|in:open,closed,maintenance',
            'thrill_level' => 'required|integer|min:1|max:5',
            'min_height' => 'required|integer|min:0',
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
            'wait_time' => 'required|integer|min:0',
            'status' => 'required|string|in:open,closed,maintenance',
            'thrill_level' => 'required|integer|min:1|max:5',
            'min_height' => 'required|integer|min:0',
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

    // Implementare metodi simili per gli altri modelli (Orders, Tickets, Shows, ecc.)
    // ...
}