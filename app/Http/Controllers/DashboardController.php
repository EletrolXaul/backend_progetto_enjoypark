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

class DashboardController extends Controller
{
    public function index()
    {
        // Recupera i dati da tutti i modelli
        $data = [
            'users' => User::all(),
            'orders' => Order::all(),
            'tickets' => Ticket::all(),
            'attractions' => Attraction::all(),
            'shows' => Show::all(),
            'restaurants' => Restaurant::all(),
            'shops' => Shop::all(),
            'services' => Service::all(),
            'locations' => Location::all(),
            'promoCodes' => PromoCode::all(),
            'visitHistories' => VisitHistory::all(),
            'mockCreditCards' => MockCreditCard::all(),
        ];

        return view('dashboard', $data);
    }
}