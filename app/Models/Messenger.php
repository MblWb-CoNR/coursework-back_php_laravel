<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['name'];

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class);
=======
    protected $fillable = [
        'name',
        'type',
        'webhook_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function signUps()
    {
        return $this->hasMany(SignUp::class);
>>>>>>> 44cb65d (migrations and models)
    }
}
