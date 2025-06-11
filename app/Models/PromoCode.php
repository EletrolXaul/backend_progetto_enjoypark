<?php
// app/Models/PromoCode.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'discount',
        'type',
        'valid_until',
        'min_amount',
        'max_discount',
        'usage_limit',
        'used_count',
        'is_active'
    ];

    protected $casts = [
        'valid_until' => 'datetime',
        'is_active' => 'boolean',
        'discount' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'max_discount' => 'decimal:2'
    ];
}