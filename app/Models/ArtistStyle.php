<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistStyle extends Model
{
    use HasFactory;

    protected $fillable = ['artist_id', 'style_name'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
