<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Location;
use App\Models\Attraction;
use App\Models\Restaurant;
use App\Models\Shop;
use App\Models\Service;
use App\Models\Show;
use Illuminate\Support\Facades\DB;

class SyncLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'locations:sync {--clean : Pulisce tutte le location esistenti prima della sincronizzazione}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincronizza la tabella locations con tutte le tabelle dedicate (attractions, restaurants, shops, services, shows)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔄 Avvio sincronizzazione locations...');
        
        try {
            DB::beginTransaction();
            
            // Opzione per pulire le location esistenti
            if ($this->option('clean')) {
                $this->info('🧹 Pulizia location esistenti...');
                Location::truncate();
            }
            
            $syncedCount = 0;
            
            // Sincronizza Attrazioni
            $this->info('🎢 Sincronizzazione attrazioni...');
            $attractions = Attraction::all();
            foreach ($attractions as $attraction) {
                $this->syncLocationFromModel($attraction, 'attraction');
                $syncedCount++;
            }
            $this->info("   ✅ {$attractions->count()} attrazioni sincronizzate");
            
            // Sincronizza Ristoranti
            $this->info('🍽️ Sincronizzazione ristoranti...');
            $restaurants = Restaurant::all();
            foreach ($restaurants as $restaurant) {
                $this->syncLocationFromModel($restaurant, 'restaurant');
                $syncedCount++;
            }
            $this->info("   ✅ {$restaurants->count()} ristoranti sincronizzati");
            
            // Sincronizza Negozi
            $this->info('🛍️ Sincronizzazione negozi...');
            $shops = Shop::all();
            foreach ($shops as $shop) {
                $this->syncLocationFromModel($shop, 'shop');
                $syncedCount++;
            }
            $this->info("   ✅ {$shops->count()} negozi sincronizzati");
            
            // Sincronizza Servizi
            $this->info('🔧 Sincronizzazione servizi...');
            $services = Service::all();
            foreach ($services as $service) {
                $this->syncLocationFromModel($service, 'service');
                $syncedCount++;
            }
            $this->info("   ✅ {$services->count()} servizi sincronizzati");
            
            // Sincronizza Spettacoli
            $this->info('🎭 Sincronizzazione spettacoli...');
            $shows = Show::all();
            foreach ($shows as $show) {
                $this->syncLocationFromModel($show, 'show');
                $syncedCount++;
            }
            $this->info("   ✅ {$shows->count()} spettacoli sincronizzati");
            
            DB::commit();
            
            $this->info("\n🎉 Sincronizzazione completata con successo!");
            $this->info("📊 Totale location sincronizzate: {$syncedCount}");
            
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("❌ Errore durante la sincronizzazione: {$e->getMessage()}");
            return 1;
        }
        
        return 0;
    }
    
    /**
     * Sincronizza una location dalla tabella specifica
     */
    private function syncLocationFromModel($model, string $category): void
    {
        // Genera un identificatore unico basato su nome e categoria
        $uniqueIdentifier = $this->generateUniqueIdentifier($model->name, $category);
        
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
        
        // Usa updateOrCreate per evitare duplicati
        Location::updateOrCreate(
            ['name' => $model->name, 'category' => $category],
            $locationData
        );
    }
    
    /**
     * Genera un identificatore unico per evitare duplicati
     */
    private function generateUniqueIdentifier(string $name, string $category): string
    {
        return md5(strtolower(trim($name)) . '_' . $category);
    }
    
    /**
     * Estrae metadata specifici per categoria
     */
    private function extractMetadata($model, string $category): array
    {
        $metadata = ['source_id' => $model->id]; // ID della tabella sorgente
        
        switch ($category) {
            case 'attraction':
                $metadata = array_merge($metadata, [
                    'wait_time' => $model->wait_time ?? null,
                    'status' => $model->status ?? 'open',
                    'thrill_level' => $model->thrill_level ?? null,
                    'min_height' => $model->min_height ?? null,
                    'duration' => $model->duration ?? null,
                    'rating' => $model->rating ?? null,
                    'capacity' => $model->capacity ?? null,
                    'features' => $model->features ?? []
                ]);
                break;
                
            case 'restaurant':
                $metadata = array_merge($metadata, [
                    'cuisine' => $model->cuisine ?? null,
                    'price_range' => $model->price_range ?? null,
                    'rating' => $model->rating ?? null,
                    'opening_hours' => $model->opening_hours ?? null,
                    'features' => $model->features ?? [],
                    'slug' => $model->slug ?? null
                ]);
                break;
                
            case 'shop':
                $metadata = array_merge($metadata, [
                    'specialties' => $model->specialties ?? [],
                    'opening_hours' => $model->opening_hours ?? null
                ]);
                break;
                
            case 'service':
                $metadata = array_merge($metadata, [
                    'available_24h' => $model->available_24h ?? false,
                    'features' => $model->features ?? []
                ]);
                break;
                
            case 'show':
                $metadata = array_merge($metadata, [
                    'venue' => $model->venue ?? null,
                    'duration' => $model->duration ?? null,
                    'times' => $model->times ?? [],
                    'capacity' => $model->capacity ?? null,
                    'available_seats' => $model->available_seats ?? null,
                    'rating' => $model->rating ?? null,
                    'price' => $model->price ?? null,
                    'age_restriction' => $model->age_restriction ?? null,
                    'slug' => $model->slug ?? null
                ]);
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
            'attraction' => ['icon' => '🎢', 'color' => '#FF6B6B'],
            'restaurant' => ['icon' => '🍽️', 'color' => '#4ECDC4'],
            'shop' => ['icon' => '🛍️', 'color' => '#45B7D1'],
            'service' => ['icon' => '🔧', 'color' => '#96CEB4'],
            'show' => ['icon' => '🎭', 'color' => '#FFEAA7']
        ];
        
        return $styles[$category] ?? ['icon' => '📍', 'color' => '#DDD'];
    }
}