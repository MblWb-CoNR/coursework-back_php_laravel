<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['user_id', 'file_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
=======
    protected $fillable = [
        'filename',
        'path',
        'url',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
>>>>>>> 44cb65d (migrations and models)
    }
}
