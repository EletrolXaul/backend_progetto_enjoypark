<?php

// app/Models/Shop.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'location_x',
        'location_y',
        'image',
        'specialties',
        'opening_hours'
    ];

    protected $casts = [
        'specialties' => 'array',
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
