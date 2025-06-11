<?php

// app/Models/Restaurant.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'cuisine',
        'price_range',
        'rating',
        'description',
        'location_x',
        'location_y',
        'image',
        'features',
        'opening_hours'
    ];

    protected $casts = [
        'features' => 'array',
        'rating' => 'decimal:2',
        'location_x' => 'decimal:6',
        'location_y' => 'decimal:6'
    ];

    public function location(): Attribute
    {
        return Attribute::make(
            get: fn() => ['x' => $this->location_x, 'y' => $this->location_y],
            set: fn($value) => ['location_x' => $value['x'], 'location_y' => $value['y']]
        );
    }
}
