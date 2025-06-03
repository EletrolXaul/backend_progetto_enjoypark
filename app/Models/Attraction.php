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

// app/Models/Service.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'location_x',
        'location_y',
        'icon',
        'available_24h',
        'features'
    ];

    protected $casts = [
        'features' => 'array',
        'available_24h' => 'boolean',
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
