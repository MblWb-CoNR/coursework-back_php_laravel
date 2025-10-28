<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'username',
        'role_id',
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

    // Отношения
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function avatar()
    {
        return $this->hasOne(Avatar::class);
    }

    public function artist()
    {
        return $this->hasOne(Artist::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // Хелперы
    public function isAdmin()
    {
        return $this->role->name === 'admin';
    }

    public function isArtist()
    {
        return $this->artist !== null;
    }
}
