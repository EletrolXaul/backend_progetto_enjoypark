<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'preferences',
        'membership',
        'is_admin',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'preferences' => 'array',
        'is_admin' => 'boolean',
    ];

    // Relazioni
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Accessor per isAdmin - usa is_admin dal database
    public function getIsAdminAttribute()
    {
        return (bool) ($this->attributes['is_admin'] ?? false);
    }
    
    // Mutator per isAdmin - imposta is_admin
    public function setIsAdminAttribute($value)
    {
        $this->attributes['is_admin'] = (bool) $value;
    }
}
