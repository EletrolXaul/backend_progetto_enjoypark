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
        'discount',
        'type',
        'description',
        'min_amount',
        'max_discount',
        'valid_until',
        'usage_limit',
        'used_count',
        'is_active',
    ];

    protected $casts = [
        'discount' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'valid_until' => 'date',
        'is_active' => 'boolean',
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where('valid_until', '>=', now()->toDateString());
    }

    public function scopeAvailable($query)
    {
        return $query->active()
                    ->where(function($q) {
                        $q->where('usage_limit', 0)
                          ->orWhereRaw('used_count < usage_limit');
                    });
    }

    // Methods
    public function isValid($amount = 0)
    {
        return $this->is_active &&
               $this->valid_until >= now()->toDateString() &&
               $amount >= $this->min_amount &&
               ($this->usage_limit == 0 || $this->used_count < $this->usage_limit);
    }

    public function calculateDiscount($amount)
    {
        if (!$this->isValid($amount)) {
            return 0;
        }

        if ($this->type === 'fixed') {
            return min($this->discount, $amount);
        }

        // Percentage discount
        $discount = ($amount * $this->discount) / 100;
        
        if ($this->max_discount) {
            $discount = min($discount, $this->max_discount);
        }

        return $discount;
    }

    public function use()
    {
        $this->increment('used_count');
    }
}