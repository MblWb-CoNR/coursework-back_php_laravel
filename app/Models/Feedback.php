<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'artist_id',
        'appointment_id',
        'rating_positive',
        'comment',
    ];

    protected $casts = [
        'rating_positive' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    // Хелпер для получения только положительных отзывов
    public function scopePositive($query)
    {
        return $query->where('rating_positive', true);
    }

    // Хелпер для получения только отрицательных отзывов
    public function scopeNegative($query)
    {
        return $query->where('rating_positive', false);
    }
}
