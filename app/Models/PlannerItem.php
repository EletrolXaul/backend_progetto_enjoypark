<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlannerItem extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'item_id',
        'name',
        'type',
        'time',
        'notes',
        'priority',
        'completed',
        'original_data'
    ];

    protected $casts = [
        'completed' => 'boolean',
        'original_data' => 'array'
    ];
}
