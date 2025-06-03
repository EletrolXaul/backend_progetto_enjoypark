<?php

namespace App\Services;

use App\Models\Attraction;
use App\Models\Show;
use App\Models\Restaurant;
use App\Models\Shop;
use App\Models\Service;
use Illuminate\Support\Collection;

class ParkDataService
{
    public function getAttractionsbyCategory(string $category): Collection
    {
        return Attraction::where('category', $category)->get();
    }

    public function getOpenAttractions(): Collection
    {
        return Attraction::where('status', 'open')->get();
    }

    public function getAttractionsByThrillLevel(int $level): Collection
    {
        return Attraction::where('thrill_level', $level)->get();
    }

    public function getShowsByTime(string $time): Collection
    {
        return Show::whereJsonContains('times', $time)->get();
    }

    public function getRestaurantsByPriceRange(string $priceRange): Collection
    {
        return Restaurant::where('price_range', $priceRange)->get();
    }

    public function getNearbyServices(float $x, float $y, float $radius = 0.001): Collection
    {
        return Service::whereBetween('location_x', [$x - $radius, $x + $radius])
            ->whereBetween('location_y', [$y - $radius, $y + $radius])
            ->get();
    }

    public function getWaitTimes(): array
    {
        return Attraction::where('status', 'open')
            ->orderBy('wait_time')
            ->pluck('wait_time', 'name')
            ->toArray();
    }

    public function getParkStats(): array
    {
        return [
            'total_attractions' => Attraction::count(),
            'open_attractions' => Attraction::where('status', 'open')->count(),
            'total_shows' => Show::count(),
            'total_restaurants' => Restaurant::count(),
            'total_shops' => Shop::count(),
            'total_services' => Service::count(),
            'average_wait_time' => Attraction::where('status', 'open')->avg('wait_time'),
            'highest_rated_attraction' => Attraction::orderBy('rating', 'desc')->first()?->name
        ];
    }
}
