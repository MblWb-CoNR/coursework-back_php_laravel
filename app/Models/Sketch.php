<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sketch extends Model
{
    use HasFactory;

    protected $fillable = ['artist_id', 'image_path', 'title', 'is_public'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Хелпер для получения только публичных эскизов
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }
}
