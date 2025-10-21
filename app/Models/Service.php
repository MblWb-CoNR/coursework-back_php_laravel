<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['name', 'description'];
=======
    protected $fillable = [
        'name',
        'description',
        'duration',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
>>>>>>> 44cb65d (migrations and models)

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

<<<<<<< HEAD
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
=======
    public function signUps()
    {
        return $this->hasMany(SignUp::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
>>>>>>> 44cb65d (migrations and models)
    }
}
