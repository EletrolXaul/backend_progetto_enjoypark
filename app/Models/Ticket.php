<?php
// app/Models/Ticket.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'visit_date',
        'ticket_type',
        'price',
        'status',
        'qr_code',
        'used_at',
        'metadata',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'used_at' => 'datetime',
        'metadata' => 'array',
        'price' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getIsValidAttribute()
    {
        return $this->status === 'valid' && $this->visit_date >= now()->toDateString();
    }
}