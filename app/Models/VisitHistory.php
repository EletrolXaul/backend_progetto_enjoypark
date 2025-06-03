<?php
// app/Models/VisitHistory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visit_date',
        'attractions',
        'rating',
        'notes',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'attractions' => 'array',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}