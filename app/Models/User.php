<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'class_id',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class)
                    ->withTimestamps()
                    ->withPivot('achieved_at');
    }

    public function notifications()
    {
        return $this->hasMany(Notifications::class, 'user_id');
    }

    public function sentNotifications()
    {
        return $this->hasMany(Notifications::class, 'sender_id');
    }

    public function unreadNotifications()
    {
        return $this->notifications()->where('is_read', false);
    }
}
