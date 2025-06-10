<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Attraction;
use App\Models\Restaurant;
use App\Models\Shop;
use App\Models\Service;
use App\Models\Show;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    /**
     * Sincronizza tutte le location dalle tabelle dedicate
     */
    public function syncLocations(): JsonResponse
    {
        try {
            // Pulisce le location esistenti
            Location::truncate();
            
            $syncedCount = 0;
            
            // Sincronizza Attrazioni
            $attractions = Attraction::all();
            foreach ($attractions as $attraction) {
                $this->createLocationFromModel($attraction, 'attraction');
                $syncedCount++;
            }
            
            // Sincronizza Ristoranti
            $restaurants = Restaurant::all();
            foreach ($restaurants as $restaurant) {
                $this->createLocationFromModel($restaurant, 'restaurant');
                $syncedCount++;
            }
            
            // Sincronizza Negozi
            $shops = Shop::all();
            foreach ($shops as $shop) {
                $this->createLocationFromModel($shop, 'shop');
                $syncedCount++;
            }
            
            // Sincronizza Servizi
            $services = Service::all();
            foreach ($services as $service) {
                $this->createLocationFromModel($service, 'service');
                $syncedCount++;
            }
            
            // Sincronizza Spettacoli
            $shows = Show::all();
            foreach ($shows as $show) {
                $this->createLocationFromModel($show, 'show');
                $syncedCount++;
            }
            
            return response()->json([
                'message' => 'Locations sincronizzate con successo',
                'synced_count' => $syncedCount
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Errore durante la sincronizzazione',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Crea una location dalla tabella specifica
     */
    private function createLocationFromModel($model, string $category): void
    {
        $locationData = [
            'name' => $model->name,
            'description' => $model->description ?? '',
            'category' => $category,
            'latitude' => $model->location_x ?? 0,
            'longitude' => $model->location_y ?? 0,
            'is_visible' => true,
            'metadata' => $this->extractMetadata($model, $category)
        ];
        
        // Determina icona e colore basati sulla categoria
        $locationData = array_merge($locationData, $this->getCategoryStyle($category));
        
        Location::create($locationData);
    }
    
    /**
     * Estrae metadata specifici per categoria
     */
    private function extractMetadata($model, string $category): array
    {
        $metadata = [];
        
        switch ($category) {
            case 'attraction':
                $metadata = [
                    'wait_time' => $model->wait_time ?? null,
                    'status' => $model->status ?? 'open',
                    'thrill_level' => $model->thrill_level ?? null,
                    'min_height' => $model->min_height ?? null,
                    'duration' => $model->duration ?? null,
                    'rating' => $model->rating ?? null,
                    'features' => $model->features ?? []
                ];
                break;
                
            case 'restaurant':
                $metadata = [
                    'cuisine' => $model->cuisine ?? null,
                    'price_range' => $model->price_range ?? null,
                    'rating' => $model->rating ?? null,
                    'opening_hours' => $model->opening_hours ?? null,
                    'features' => $model->features ?? []
                ];
                break;
                
            case 'shop':
                $metadata = [
                    'specialties' => $model->specialties ?? [],
                    'opening_hours' => $model->opening_hours ?? null
                ];
                break;
                
            case 'service':
                $metadata = [
                    'available_24h' => $model->available_24h ?? false,
                    'features' => $model->features ?? []
                ];
                break;
                
            case 'show':
                $metadata = [
                    'venue' => $model->venue ?? null,
                    'duration' => $model->duration ?? null,
                    'times' => $model->times ?? [],
                    'capacity' => $model->capacity ?? null,
                    'available_seats' => $model->available_seats ?? null,
                    'rating' => $model->rating ?? null,
                    'price' => $model->price ?? null,
                    'age_restriction' => $model->age_restriction ?? null
                ];
                break;
        }
        
        return $metadata;
    }
    
    /**
     * Restituisce stile (icona e colore) per categoria
     */
    private function getCategoryStyle(string $category): array
    {
        $styles = [
            'attraction' => ['icon' => 'roller-coaster', 'color' => '#FF6B6B'],
            'restaurant' => ['icon' => 'restaurant', 'color' => '#4ECDC4'],
            'shop' => ['icon' => 'shopping-bag', 'color' => '#45B7D1'],
            'service' => ['icon' => 'info', 'color' => '#96CEB4'],
            'show' => ['icon' => 'theater', 'color' => '#FFEAA7']
        ];
        
        return $styles[$category] ?? ['icon' => 'map-pin', 'color' => '#DDD'];
    }
    
    /**
     * Ottiene tutte le location con filtri
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Location::visible();
            
            // Filtro per categoria
            if ($request->has('category')) {
                $query->byCategory($request->category);
            }
            
            // Filtro per area geografica
            if ($request->has('bounds')) {
                $bounds = $request->bounds;
                $query->whereBetween('latitude', [$bounds['south'], $bounds['north']])
                      ->whereBetween('longitude', [$bounds['west'], $bounds['east']]);
            }
            
            $locations = $query->get();
            
            return response()->json([
                'data' => $locations,
                'count' => $locations->count()
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Errore nel recupero delle location',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Ottiene dettagli di una location specifica
     */
    public function show(int $id): JsonResponse
    {
        try {
            $location = Location::findOrFail($id);
            
            // Recupera i dettagli dalla tabella specifica
            $details = $this->getDetailedInfo($location);
            
            return response()->json([
                'data' => array_merge($location->toArray(), ['details' => $details])
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Location non trovata',
                'message' => $e->getMessage()
            ], 404);
        }
    }
    
    /**
     * Recupera informazioni dettagliate dalla tabella specifica
     */
    private function getDetailedInfo(Location $location): ?object
    {
        switch ($location->category) {
            case 'attraction':
                return Attraction::where('name', $location->name)->first();
            case 'restaurant':
                return Restaurant::where('name', $location->name)->first();
            case 'shop':
                return Shop::where('name', $location->name)->first();
            case 'service':
                return Service::where('name', $location->name)->first();
            case 'show':
                return Show::where('name', $location->name)->first();
            default:
                return null;
        }
    }
}
