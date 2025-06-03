<?php
// app/Models/MockCreditCard.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockCreditCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'name',
        'expiry',
        'cvv',
        'type',
        'result',
        'message',
    ];

    public static function validateCard($cardNumber)
    {
        $cleanNumber = str_replace(' ', '', $cardNumber);
        return self::where('number', $cleanNumber)->first();
    }
}