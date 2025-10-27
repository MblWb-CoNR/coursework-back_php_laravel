<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'artist_id',
        'service_id',
        'artist_style_id',
        'sketch_id',
        'custom_sketch_path',
        'appointment_date',
        'appointment_time',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function artistStyle() // ← ДОБАВИЛИ НОВОЕ ОТНОШЕНИЕ
    {
        return $this->belongsTo(ArtistStyle::class);
    }

    public function sketch()
    {
        return $this->belongsTo(Sketch::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

    // Хелперы для статусов
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }
}
