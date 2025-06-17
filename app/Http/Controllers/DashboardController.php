<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\Attraction;
use App\Models\Show;
use App\Models\Restaurant;
use App\Models\Shop;
use App\Models\Service;
use App\Models\PromoCode;
use App\Models\VisitHistory;
use App\Models\MockCreditCard;
use App\Models\PlannerItem; // Aggiungi questo import
use Illuminate\Http\Request;

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
            'ticketTypes' => TicketType::paginate(10),
            'tickets' => Ticket::paginate(10),
            'attractions' => $attractions,
            'shows' => $shows,
            'restaurants' => $restaurants,
            'shops' => $shops,
            'services' => Service::paginate(10),
            'promoCodes' => PromoCode::paginate(10),
            'visitHistories' => VisitHistory::paginate(10),
            'mockCreditCards' => MockCreditCard::paginate(10),
            'plannerItems' => PlannerItem::with('user')->orderBy('created_at', 'desc')->paginate(10), // Aggiungi questa riga
        ];

        // Aggiunta di statistiche per la dashboard
        $stats = [
            'totalUsers' => User::count(),
            'totalOrders' => Order::count(),
            'totalTicketTypes' => TicketType::count(),
            'totalTickets' => Ticket::count(),
            'totalAttractions' => Attraction::count(),
            'totalPlannerItems' => PlannerItem::count(), // Aggiungi questa riga
            'recentOrders' => Order::orderBy('created_at', 'desc')->take(5)->get(),
            'recentUsers' => User::orderBy('created_at', 'desc')->take(5)->get(),
        ];

        return view('dashboard.index', array_merge($data, ['stats' => $stats]));
    }

    public function getShow($id)
    {
        $show = Show::find($id);
        if (!$show) {
            return response()->json(['message' => 'Spettacolo non trovato'], 404);
        }
        return response()->json($show);
    }

    public function getStats()
    {
        return response()->json([
            'totalUsers' => User::count(),
            'totalOrders' => Order::count(),
            'totalTickets' => Ticket::count(),
            'totalRevenue' => Order::sum('total_price'),
            'todayOrders' => Order::whereDate('created_at', today())->count(),
            'activeShows' => Show::count() // Changed from Show::where('status', 'active')->count()
        ]);
    }
}