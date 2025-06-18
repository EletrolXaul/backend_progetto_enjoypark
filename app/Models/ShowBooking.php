<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShowBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'show_id',
        'booking_date',
        'time_slot',
        'seats_booked',
        'status'
    ];

    protected $casts = [
        'booking_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function show(): BelongsTo
    {
        return $this->belongsTo(Show::class);
    }
}
