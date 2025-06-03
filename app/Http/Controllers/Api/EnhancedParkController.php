<?php
// app/Http/Controllers/Api/EnhancedParkController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttractionResource;
use App\Services\ParkDataService;
use App\Models\Attraction;
use App\Models\Show;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EnhancedParkController extends Controller
{
    public function __construct(
        private ParkDataService $parkService
    ) {}

    /**
     * Attrazioni con filtri avanzati
     */
    public function attractions(Request $request): JsonResponse
    {
        $query = Attraction::query();

        // Filtro per categoria
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filtro per status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filtro per livello di brivido
        if ($request->has('thrill_level')) {
            $query->where('thrill_level', $request->thrill_level);
        }

        // Filtro per tempo di attesa massimo
        if ($request->has('max_wait')) {
            $query->where('wait_time', '<=', $request->max_wait);
        }

        // Filtro per altezza minima
        if ($request->has('min_height')) {
            $query->where('min_height', '<=', $request->min_height);
        }

        // Ordinamento
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');
        
        if (in_array($sortBy, ['name', 'wait_time', 'rating', 'thrill_level'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        $attractions = $query->get();
        
        return response()->json(AttractionResource::collection($attractions));
    }

    /**
     * Spettacoli con filtri temporali
     */
    public function shows(Request $request): JsonResponse
    {
        $query = Show::query();

        // Filtro per categoria
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filtro per orario specifico
        if ($request->has('time')) {
            $query->whereJsonContains('times', $request->time);
        }

        // Filtro per prezzo massimo
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Solo spettacoli con posti disponibili
        if ($request->boolean('available_only')) {
            $query->where('available_seats', '>', 0);
        }

        $shows = $query->orderBy('name')->get();

        return response()->json($shows->map(function ($show) {
            return [
                'id' => (string) $show->id,
                'name' => $show->name,
                'description' => $show->description,
                'venue' => $show->venue,
                'duration' => $show->duration,
                'category' => $show->category,
                'times' => $show->times,
                'capacity' => $show->capacity,
                'availableSeats' => $show->available_seats,
                'rating' => (float) $show->rating,
                'price' => (float) $show->price,
                'ageRestriction' => $show->age_restriction,
                'location' => $show->location,
                'image' => $show->image,
                'isAvailable' => $show->available_seats > 0,
                'occupancyRate' => round((($show->capacity - $show->available_seats) / $show->capacity) * 100, 1)
            ];
        }));
    }

    /**
     * Ristoranti con filtri dettagliati
     */
    public function restaurants(Request $request): JsonResponse
    {
        $query = Restaurant::query();

        // Filtro per categoria
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filtro per tipo di cucina
        if ($request->has('cuisine')) {
            $query->where('cuisine', $request->cuisine);
        }

        // Filtro per fascia di prezzo
        if ($request->has('price_range')) {
            $query->where('price_range', $request->price_range);
        }

        // Filtro per rating minimo
        if ($request->has('min_rating')) {
            $query->where('rating', '>=', $request->min_rating);
        }

        // Cerca per caratteristiche specifiche
        if ($request->has('feature')) {
            $query->whereJsonContains('features', $request->feature);
        }

        $restaurants = $query->orderBy('rating', 'desc')->get();

        return response()->json($restaurants->map(function ($restaurant) {
            return [
                'id' => (string) $restaurant->id,
                'name' => $restaurant->name,
                'category' => $restaurant->category,
                'cuisine' => $restaurant->cuisine,
                'priceRange' => $restaurant->price_range,
                'rating' => (float) $restaurant->rating,
                'description' => $restaurant->description,
                'location' => $restaurant->location,
                'image' => $restaurant->image,
                'features' => $restaurant->features,
                'openingHours' => $restaurant->opening_hours,
                'priceSymbol' => str_repeat('€', strlen($restaurant->price_range)),
                'isHighRated' => $restaurant->rating >= 4.5
            ];
        }));
    }

    /**
     * Statistiche del parco in tempo reale
     */
    public function stats(): JsonResponse
    {
        return response()->json($this->parkService->getParkStats());
    }

    /**
     * Tempi di attesa in tempo reale
     */
    public function waitTimes(): JsonResponse
    {
        return response()->json($this->parkService->getWaitTimes());
    }
    
    /**
     * Ricerca servizi nelle vicinanze
     */
    public function nearbyServices(Request $request): JsonResponse
    {
        $x = $request->get('x', 0);
        $y = $request->get('y', 0);
        $radius = $request->get('radius', 0.001);

        $services = $this->parkService->getNearbyServices($x, $y, $radius);

        return response()->json($services);
    }

    /**
     * Ricerca globale
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([
                'attractions' => [],
                'shows' => [],
                'restaurants' => [],
                'shops' => [],
                'services' => []
            ]);
        }

        return response()->json([
            'attractions' => Attraction::where('name', 'LIKE', "%{$query}%")
                                     ->orWhere('description', 'LIKE', "%{$query}%")
                                     ->take(5)->get(),
            'shows' => Show::where('name', 'LIKE', "%{$query}%")
                          ->orWhere('description', 'LIKE', "%{$query}%")
                          ->take(5)->get(),
            'restaurants' => Restaurant::where('name', 'LIKE', "%{$query}%")
                                     ->orWhere('cuisine', 'LIKE', "%{$query}%")
                                     ->take(5)->get()
        ]);
    }
}