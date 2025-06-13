<?php
// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'tickets',
        'total_price',
        'purchase_date',
        'visit_date',
        'status',
        'qr_codes',
        'customer_info',
        'payment_method',
        'promo_code',
        'discount_amount',
    ];

    protected $casts = [
        'tickets' => 'array',
        'qr_codes' => 'array',
        'customer_info' => 'array',
        'payment_method' => 'array',
        'purchase_date' => 'datetime',
        'visit_date' => 'date',
        'total_price' => 'decimal:2',
        'discount_amount' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketItems()
    {
        return $this->hasMany(Ticket::class, 'order_number', 'order_number');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['confirmed', 'pending']);
    }

    public function scopeForDate($query, $date)
    {
        return $query->where('visit_date', $date);
    }

    // Accessors
    public function getIsValidAttribute()
    {
        return in_array($this->status, ['confirmed', 'pending']) && 
               $this->visit_date >= Carbon::now()->toDateString();
    }

    public function getTotalTicketsAttribute()
    {
        return is_array($this->tickets) ? array_sum($this->tickets) : 0;
    }

    public static function generateOrderNumber()
    {
        return 'ORDER-' . time() . rand(100, 999);
    }
}