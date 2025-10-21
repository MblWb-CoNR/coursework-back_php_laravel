<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'messenger_id',
        'service_id',
        'signup_date',
        'status',
    ];

    protected $casts = [
        'signup_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messenger()
    {
        return $this->belongsTo(Messenger::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
