<?php
// app/Models/Ticket.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'ticket_type_id',
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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function ticketType()
    {
        return $this->belongsTo(TicketType::class);
    }

    // Accessors
    public function getIsValidAttribute()
    {
        return $this->status === 'valid' && $this->visit_date >= date('Y-m-d');
    }

    // Auto-generate QR code
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($ticket) {
            if (empty($ticket->qr_code)) {
                $ticket->qr_code = 'QR_' . Str::random(16) . '_' . time();
            }
        });
    }
}