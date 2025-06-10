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

class CleanDuplicates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duplicates:clean {--table=all : Specifica quale tabella pulire (all, locations, attractions, restaurants, shops, services, shows)} {--dry-run : Mostra cosa verrebbe eliminato senza effettuare modifiche}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rimuove i duplicati da tutte le tabelle o da una tabella specifica';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = $this->option('table');
        $dryRun = $this->option('dry-run');
        
        if ($dryRun) {
            $this->warn('🔍 MODALITÀ DRY-RUN: Nessuna modifica verrà effettuata');
        }
        
        $this->info('🧹 Avvio pulizia duplicati...');
        
        try {
            if (!$dryRun) {
                DB::beginTransaction();
            }
            
            $totalRemoved = 0;
            
            if ($table === 'all' || $table === 'locations') {
                $removed = $this->cleanLocationDuplicates($dryRun);
                $totalRemoved += $removed;
                $this->info("📍 Locations: {$removed} duplicati " . ($dryRun ? 'trovati' : 'rimossi'));
            }
            
            if ($table === 'all' || $table === 'attractions') {
                $removed = $this->cleanAttractionDuplicates($dryRun);
                $totalRemoved += $removed;
                $this->info("🎢 Attractions: {$removed} duplicati " . ($dryRun ? 'trovati' : 'rimossi'));
            }
            
            if ($table === 'all' || $table === 'restaurants') {
                $removed = $this->cleanRestaurantDuplicates($dryRun);
                $totalRemoved += $removed;
                $this->info("🍽️ Restaurants: {$removed} duplicati " . ($dryRun ? 'trovati' : 'rimossi'));
            }
            
            if ($table === 'all' || $table === 'shops') {
                $removed = $this->cleanShopDuplicates($dryRun);
                $totalRemoved += $removed;
                $this->info("🛍️ Shops: {$removed} duplicati " . ($dryRun ? 'trovati' : 'rimossi'));
            }
            
            if ($table === 'all' || $table === 'services') {
                $removed = $this->cleanServiceDuplicates($dryRun);
                $totalRemoved += $removed;
                $this->info("🔧 Services: {$removed} duplicati " . ($dryRun ? 'trovati' : 'rimossi'));
            }
            
            if ($table === 'all' || $table === 'shows') {
                $removed = $this->cleanShowDuplicates($dryRun);
                $totalRemoved += $removed;
                $this->info("🎭 Shows: {$removed} duplicati " . ($dryRun ? 'trovati' : 'rimossi'));
            }
            
            if (!$dryRun) {
                DB::commit();
                $this->info("\n✅ Pulizia completata! Totale duplicati rimossi: {$totalRemoved}");
            } else {
                $this->info("\n🔍 Analisi completata! Totale duplicati trovati: {$totalRemoved}");
                $this->warn('Per rimuovere effettivamente i duplicati, esegui il comando senza --dry-run');
            }
            
        } catch (\Exception $e) {
            if (!$dryRun) {
                DB::rollBack();
            }
            $this->error("❌ Errore durante la pulizia: {$e->getMessage()}");
            return 1;
        }
        
        return 0;
    }
    
    /**
     * Pulisce i duplicati dalla tabella locations
     */
    private function cleanLocationDuplicates(bool $dryRun = false): int
    {
        // Trova duplicati basati su nome e categoria
        $duplicates = DB::select("
            SELECT name, category, COUNT(*) as count, 
                   GROUP_CONCAT(id ORDER BY id) as ids
            FROM locations 
            GROUP BY name, category 
            HAVING COUNT(*) > 1
        ");
        
        $removedCount = 0;
        
        foreach ($duplicates as $duplicate) {
            $ids = explode(',', $duplicate->ids);
            // Mantieni il primo record (ID più basso) e rimuovi gli altri
            $idsToRemove = array_slice($ids, 1);
            
            if ($dryRun) {
                $this->line("   🔍 Trovati duplicati per '{$duplicate->name}' ({$duplicate->category}): " . implode(', ', $idsToRemove));
                $removedCount += count($idsToRemove);
            } else {
                Location::whereIn('id', $idsToRemove)->delete();
                $removedCount += count($idsToRemove);
                $this->line("   ✅ Rimossi duplicati per '{$duplicate->name}' ({$duplicate->category})");
            }
        }
        
        return $removedCount;
    }
    
    /**
     * Pulisce i duplicati dalla tabella attractions
     */
    private function cleanAttractionDuplicates(bool $dryRun = false): int
    {
        $duplicates = DB::select("
            SELECT name, COUNT(*) as count, 
                   GROUP_CONCAT(id ORDER BY id) as ids
            FROM attractions 
            GROUP BY name 
            HAVING COUNT(*) > 1
        ");
        
        $removedCount = 0;
        
        foreach ($duplicates as $duplicate) {
            $ids = explode(',', $duplicate->ids);
            $idsToRemove = array_slice($ids, 1);
            
            if ($dryRun) {
                $this->line("   🔍 Trovati duplicati per attrazione '{$duplicate->name}': " . implode(', ', $idsToRemove));
                $removedCount += count($idsToRemove);
            } else {
                Attraction::whereIn('id', $idsToRemove)->delete();
                $removedCount += count($idsToRemove);
                $this->line("   ✅ Rimossi duplicati per attrazione '{$duplicate->name}'");
            }
        }
        
        return $removedCount;
    }
    
    /**
     * Pulisce i duplicati dalla tabella restaurants
     */
    private function cleanRestaurantDuplicates(bool $dryRun = false): int
    {
        $duplicates = DB::select("
            SELECT name, COUNT(*) as count, 
                   GROUP_CONCAT(id ORDER BY id) as ids
            FROM restaurants 
            GROUP BY name 
            HAVING COUNT(*) > 1
        ");
        
        $removedCount = 0;
        
        foreach ($duplicates as $duplicate) {
            $ids = explode(',', $duplicate->ids);
            $idsToRemove = array_slice($ids, 1);
            
            if ($dryRun) {
                $this->line("   🔍 Trovati duplicati per ristorante '{$duplicate->name}': " . implode(', ', $idsToRemove));
                $removedCount += count($idsToRemove);
            } else {
                Restaurant::whereIn('id', $idsToRemove)->delete();
                $removedCount += count($idsToRemove);
                $this->line("   ✅ Rimossi duplicati per ristorante '{$duplicate->name}'");
            }
        }
        
        return $removedCount;
    }
    
    /**
     * Pulisce i duplicati dalla tabella shops
     */
    private function cleanShopDuplicates(bool $dryRun = false): int
    {
        $duplicates = DB::select("
            SELECT name, COUNT(*) as count, 
                   GROUP_CONCAT(id ORDER BY id) as ids
            FROM shops 
            GROUP BY name 
            HAVING COUNT(*) > 1
        ");
        
        $removedCount = 0;
        
        foreach ($duplicates as $duplicate) {
            $ids = explode(',', $duplicate->ids);
            $idsToRemove = array_slice($ids, 1);
            
            if ($dryRun) {
                $this->line("   🔍 Trovati duplicati per negozio '{$duplicate->name}': " . implode(', ', $idsToRemove));
                $removedCount += count($idsToRemove);
            } else {
                Shop::whereIn('id', $idsToRemove)->delete();
                $removedCount += count($idsToRemove);
                $this->line("   ✅ Rimossi duplicati per negozio '{$duplicate->name}'");
            }
        }
        
        return $removedCount;
    }
    
    /**
     * Pulisce i duplicati dalla tabella services
     */
    private function cleanServiceDuplicates(bool $dryRun = false): int
    {
        $duplicates = DB::select("
            SELECT name, COUNT(*) as count, 
                   GROUP_CONCAT(id ORDER BY id) as ids
            FROM services 
            GROUP BY name 
            HAVING COUNT(*) > 1
        ");
        
        $removedCount = 0;
        
        foreach ($duplicates as $duplicate) {
            $ids = explode(',', $duplicate->ids);
            $idsToRemove = array_slice($ids, 1);
            
            if ($dryRun) {
                $this->line("   🔍 Trovati duplicati per servizio '{$duplicate->name}': " . implode(', ', $idsToRemove));
                $removedCount += count($idsToRemove);
            } else {
                Service::whereIn('id', $idsToRemove)->delete();
                $removedCount += count($idsToRemove);
                $this->line("   ✅ Rimossi duplicati per servizio '{$duplicate->name}'");
            }
        }
        
        return $removedCount;
    }
    
    /**
     * Pulisce i duplicati dalla tabella shows
     */
    private function cleanShowDuplicates(bool $dryRun = false): int
    {
        $duplicates = DB::select("
            SELECT name, COUNT(*) as count, 
                   GROUP_CONCAT(id ORDER BY id) as ids
            FROM shows 
            GROUP BY name 
            HAVING COUNT(*) > 1
        ");
        
        $removedCount = 0;
        
        foreach ($duplicates as $duplicate) {
            $ids = explode(',', $duplicate->ids);
            $idsToRemove = array_slice($ids, 1);
            
            if ($dryRun) {
                $this->line("   🔍 Trovati duplicati per spettacolo '{$duplicate->name}': " . implode(', ', $idsToRemove));
                $removedCount += count($idsToRemove);
            } else {
                Show::whereIn('id', $idsToRemove)->delete();
                $removedCount += count($idsToRemove);
                $this->line("   ✅ Rimossi duplicati per spettacolo '{$duplicate->name}'");
            }
        }
        
        return $removedCount;
    }
}
