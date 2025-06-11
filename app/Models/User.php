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
        'isAdmin',
        'is_admin', // Aggiungi anche is_admin ai fillable
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'isAdmin' => 'boolean',
        'is_admin' => 'boolean', // Aggiungi anche is_admin ai casts
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

    // Accessor per isAdmin - converte is_admin in isAdmin
    public function getIsAdminAttribute($value)
    {
        // Se isAdmin è già impostato, usa quel valore
        if (isset($this->attributes['isAdmin'])) {
            return (bool) $this->attributes['isAdmin'];
        }
        
        // Altrimenti usa is_admin dal database
        return (bool) ($this->attributes['is_admin'] ?? false);
    }
    
    // Mutator per isAdmin - imposta anche is_admin
    public function setIsAdminAttribute($value)
    {
        $this->attributes['isAdmin'] = (bool) $value;
        $this->attributes['is_admin'] = (bool) $value;
    }
    
    // Accessor per is_admin - usa isAdmin se disponibile
    public function getIsAdminColumnAttribute()
    {
        return (bool) ($this->attributes['is_admin'] ?? $this->attributes['isAdmin'] ?? false);
    }
    
    // Mutator per is_admin - imposta anche isAdmin
    public function setIsAdminColumnAttribute($value)
    {
        $this->attributes['is_admin'] = (bool) $value;
        $this->attributes['isAdmin'] = (bool) $value;
    }
}