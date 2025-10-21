<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
<<<<<<< HEAD
        'email',
        'password',
        'username',
=======
        'name',
        'email',
        'password',
        'avatar_id',
>>>>>>> 44cb65d (migrations and models)
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

<<<<<<< HEAD
    // Отношения
=======
    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }

>>>>>>> 44cb65d (migrations and models)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

<<<<<<< HEAD
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
=======
    public function signUps()
    {
        return $this->hasMany(SignUp::class);
>>>>>>> 44cb65d (migrations and models)
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

<<<<<<< HEAD
    // Хелперы
    public function isAdmin()
    {
        return $this->role->name === 'admin';
    }

    public function isArtist()
    {
        return $this->artist !== null;
=======
    public function sketches()
    {
        return $this->hasMany(Sketch::class);
>>>>>>> 44cb65d (migrations and models)
    }
}
