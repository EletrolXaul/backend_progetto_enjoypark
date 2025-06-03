<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        $this->call([
            AttractionSeeder::class,
            ShowsTableSeeder::class,
            RestaurantsTableSeeder::class,
            ShopTableSeeder::class,
            ServiceTableSeeder::class,
            UserSeeder::class,
            VisitHistorySeeder::class,
            TicketSeeder::class,
        ]);
    }
}
