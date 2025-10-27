<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bio', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function styles()
    {
        return $this->hasMany(ArtistStyle::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function sketches()
    {
        return $this->hasMany(Sketch::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // Хелпер для получения активных мастеров
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
