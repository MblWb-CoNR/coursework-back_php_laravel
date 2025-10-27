<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['artist_id', 'service_id', 'price'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
