<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Show;
use App\Models\ShowBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShowBookingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'show_id' => 'required|exists:shows,id',
            'time_slot' => 'required|string',
            'seats_booked' => 'integer|min:1|max:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $userId = Auth::id();
        $showId = $request->show_id;
        $timeSlot = $request->time_slot;
        $seatsBooked = $request->seats_booked ?? 1;
        $bookingDate = today();

        try {
            return DB::transaction(function () use ($userId, $showId, $timeSlot, $seatsBooked, $bookingDate) {
                // Usa updateOrCreate per gestire automaticamente i duplicati
                $booking = ShowBooking::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'show_id' => $showId,
                        'booking_date' => $bookingDate,
                    ],
                    [
                        'time_slot' => $timeSlot,
                        'seats_booked' => $seatsBooked,
                        'status' => 'confirmed'
                    ]
                );

                // Se è una nuova prenotazione, aggiorna i posti
                if ($booking->wasRecentlyCreated) {
                    $show = Show::findOrFail($showId);
                    if ($show->available_seats < $seatsBooked) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Posti non disponibili'
                        ], 409);
                    }
                    $show->decrement('available_seats', $seatsBooked);
                }

                return response()->json([
                    'success' => true,
                    'message' => $booking->wasRecentlyCreated ? 'Prenotazione confermata' : 'Prenotazione già esistente',
                    'booking' => $booking->load('show'),
                    'available_seats' => Show::find($showId)->available_seats
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore durante la prenotazione: ' . $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        try {
            $bookings = ShowBooking::with('show')
                ->where('user_id', Auth::id())
                ->where('status', 'confirmed')
                ->orderBy('booking_date', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'bookings' => $bookings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nel recupero delle prenotazioni'
            ], 500);
        }
    }
}
