<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Aggiungi vincolo di unicità per attractions
        Schema::table('attractions', function (Blueprint $table) {
            $table->unique('name', 'attractions_name_unique');
        });
        
        // Aggiungi vincolo di unicità per restaurants
        Schema::table('restaurants', function (Blueprint $table) {
            $table->unique('name', 'restaurants_name_unique');
            $table->unique('slug', 'restaurants_slug_unique');
        });
        
        // Aggiungi vincolo di unicità per shops
        Schema::table('shops', function (Blueprint $table) {
            $table->unique('name', 'shops_name_unique');
        });
        
        // Aggiungi vincolo di unicità per services
        Schema::table('services', function (Blueprint $table) {
            $table->unique('name', 'services_name_unique');
        });
        
        // Aggiungi vincolo di unicità per shows
        Schema::table('shows', function (Blueprint $table) {
            $table->unique('name', 'shows_name_unique');
            $table->unique('slug', 'shows_slug_unique');
        });
        
        // Migliora il vincolo di locations (nome + categoria)
        Schema::table('locations', function (Blueprint $table) {
            $table->dropUnique('locations_name_unique'); // Rimuovi il vecchio
            $table->unique(['name', 'category'], 'locations_name_category_unique');
        });
    }

    public function down(): void
    {
        Schema::table('attractions', function (Blueprint $table) {
            $table->dropUnique('attractions_name_unique');
        });
        
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropUnique('restaurants_name_unique');
            $table->dropUnique('restaurants_slug_unique');
        });
        
        Schema::table('shops', function (Blueprint $table) {
            $table->dropUnique('shops_name_unique');
        });
        
        Schema::table('services', function (Blueprint $table) {
            $table->dropUnique('services_name_unique');
        });
        
        Schema::table('shows', function (Blueprint $table) {
            $table->dropUnique('shows_name_unique');
            $table->dropUnique('shows_slug_unique');
        });
        
        Schema::table('locations', function (Blueprint $table) {
            $table->dropUnique('locations_name_category_unique');
            $table->unique('name', 'locations_name_unique');
        });
    }
};