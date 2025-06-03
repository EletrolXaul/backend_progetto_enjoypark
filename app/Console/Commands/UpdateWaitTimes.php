<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Attraction;

class UpdateWaitTimes extends Command
{
    protected $signature = 'park:update-wait-times';
    protected $description = 'Aggiorna i tempi di attesa delle attrazioni';

    public function handle(): int
    {
        $attractions = Attraction::where('status', 'open')->get();

        foreach ($attractions as $attraction) {
            // Simula variazioni realistiche dei tempi di attesa
            $currentWait = $attraction->wait_time;
            $variation = rand(-5, 10); // Variazione tra -5 e +10 minuti
            $newWait = max(0, $currentWait + $variation);

            $attraction->update(['wait_time' => $newWait]);
        }

        $this->info("Aggiornati i tempi di attesa per {$attractions->count()} attrazioni");
        return 0;
    }
}
