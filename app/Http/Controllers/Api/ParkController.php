<?php
// app/Http/Controllers/Api/ParkController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attraction;
use App\Models\Show;
use App\Models\Restaurant;
use App\Models\Shop;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class ParkController extends Controller
{
    public function attractions(): JsonResponse
    {
        $attractions = Attraction::all()->map(function ($attraction) {
            return [
                'id' => (string) $attraction->id,
                'name' => $attraction->name,
                'category' => $attraction->category,
                'waitTime' => $attraction->wait_time,
                'status' => $attraction->status,
                'thrillLevel' => $attraction->thrill_level,
                'minHeight' => $attraction->min_height,
                'description' => $attraction->description,
                'duration' => $attraction->duration,
                'capacity' => $attraction->capacity,
                'rating' => (float) $attraction->rating,
                'location' => $attraction->location,
                'image' => $attraction->image,
                'features' => $attraction->features
            ];
        });

        return response()->json($attractions);
    }

    public function shows(): JsonResponse
    {
        $shows = Show::all()->map(function ($show) {
            // Ottieni la data di oggi
            $today = now()->format('Y-m-d');
            
            // Prendi il primo orario disponibile o un orario di default
            $firstTime = is_array($show->times) && count($show->times) > 0 
                ? $show->times[0] 
                : '15:00';
            
            return [
                'id' => (string) $show->id,
                'name' => $show->name,
                'description' => $show->description,
                'venue' => $show->venue,
                'duration' => $show->duration,
                'category' => $show->category,
                'time' => $firstTime,  // Singolo orario
                'date' => $today,      // Data di oggi
                'times' => $show->times, // Mantieni anche l'array originale
                'capacity' => $show->capacity,
                'availableSeats' => $show->available_seats,
                'rating' => (float) $show->rating,
                'price' => (float) $show->price,
                'ageRestriction' => $show->age_restriction,
                'location' => $show->location,
                'image' => $show->image
            ];
        });

        return response()->json($shows);
    }

    public function restaurants(): JsonResponse
    {
        $restaurants = Restaurant::all()->map(function ($restaurant) {
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
                'openingHours' => $restaurant->opening_hours
            ];
        });

        return response()->json($restaurants);
    }

    public function shops(): JsonResponse
    {
        $shops = Shop::all()->map(function ($shop) {
            return [
                'id' => (string) $shop->id,
                'name' => $shop->name,
                'category' => $shop->category,
                'description' => $shop->description,
                'location' => $shop->location,
                'image' => $shop->image,
                'specialties' => $shop->specialties,
                'openingHours' => $shop->opening_hours
            ];
        });

        return response()->json($shops);
    }

    public function services(): JsonResponse
    {
        $services = Service::all()->map(function ($service) {
            return [
                'id' => (string) $service->id,
                'name' => $service->name,
                'category' => $service->category,
                'description' => $service->description,
                'location' => $service->location,
                'icon' => $service->icon,
                'available24h' => $service->available_24h,
                'features' => $service->features
            ];
        });

        return response()->json($services);
    }

    public function allData(): JsonResponse
    {
        return response()->json([
            'attractions' => $this->attractions()->getData(),
            'shows' => $this->shows()->getData(),
            'restaurants' => $this->restaurants()->getData(),
            'shops' => $this->shops()->getData(),
            'services' => $this->services()->getData()
        ]);
    }
}