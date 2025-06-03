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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'preferences' => 'array',
        'is_admin' => 'boolean',
    ];

    // Relationships
    public function visitHistories()
    {
        return $this->hasMany(VisitHistory::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Accessors
    public function getPreferenceAttribute($key, $default = null)
    {
        return $this->preferences[$key] ?? $default;
    }

    public function setPreferenceAttribute($key, $value)
    {
        $preferences = $this->preferences ?? [];
        $preferences[$key] = $value;
        $this->preferences = $preferences;
    }
}