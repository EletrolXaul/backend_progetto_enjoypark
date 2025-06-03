<?php
// app/Models/Order.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
               $this->visit_date >= now()->toDateString();
    }

    public function getTotalTicketsAttribute()
    {
        return array_sum($this->tickets);
    }

    // Methods
    public function generateQRCodes()
    {
        $codes = [];
        $totalTickets = $this->getTotalTicketsAttribute();
        
        for ($i = 0; $i < $totalTickets; $i++) {
            $codes[] = $this->generateQRCode();
        }
        
        $this->qr_codes = $codes;
        $this->save();
        return $codes;
    }

    private function generateQRCode()
    {
        $timestamp = now()->timestamp;
        $random = strtoupper(substr(md5(uniqid()), 0, 6));
        return "EP-{$timestamp}-{$random}";
    }

    public static function generateOrderNumber()
    {
        return 'ORDER-' . now()->timestamp . rand(100, 999);
    }
}