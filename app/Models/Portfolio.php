<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = ['artist_id', 'image_path', 'title', 'description'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
