<?php
// app/Models/Location.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'latitude',
        'longitude',
        'icon',
        'color',
        'metadata',
        'is_visible',
    ];

    protected $casts = [
        'metadata' => 'array',
        'is_visible' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Scopes
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}