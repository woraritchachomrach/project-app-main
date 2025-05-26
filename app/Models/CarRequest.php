<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_image',
        'name',
        'position',
        'department',
        'start_time',
        'end_time',
        'destination',
        'seats',
        'car_registration',
        'driver',
        'reason',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
