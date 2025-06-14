<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens; 

    protected $fillable = [
        'name',
        'email', 
        'password',
        'is_admin',
        'preferences',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
        'preferences' => 'array',
    ];

    protected $hidden = [
        'password',
        'remember_token',
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

    // Accessor per isAdmin
    public function getIsAdminAttribute()
    {
        return (bool) ($this->attributes['is_admin'] ?? false);
    }
    
    // Mutator per isAdmin
    public function setIsAdminAttribute($value)
    {
        $this->attributes['is_admin'] = (bool) $value;
    }
}
