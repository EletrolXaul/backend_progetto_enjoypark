<?php
// app/Models/Attraction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Attraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'wait_time',
        'status',
        'thrill_level',
        'min_height',
        'description',
        'duration',
        'capacity',
        'rating',
        'location_x',
        'location_y',
        'image',
        'features'
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