<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = ['name'];
=======
    protected $fillable = [
        'name',
        'description',
        'permissions',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];
>>>>>>> 44cb65d (migrations and models)

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
