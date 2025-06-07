<?php

// app/Models/Show.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Show extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'venue',
        'duration',
        'category',
        'times',
        'capacity',
        'available_seats',
        'rating',
        'price',
        'age_restriction',
        'location_x',
        'location_y',
        'image'
    ];

    protected $casts = [
        'times' => 'array',
        'rating' => 'decimal:2',
        'price' => 'decimal:2',
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
