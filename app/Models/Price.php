<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['artist_id', 'service_id', 'price'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
=======
    protected $fillable = [
        'service_id',
        'amount',
        'currency',
        'valid_from',
        'valid_to',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
    ];
>>>>>>> 44cb65d (migrations and models)

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
