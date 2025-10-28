<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messenger extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function userProfiles()
    {
        return $this->hasMany(UserProfile::class);
    }
}
