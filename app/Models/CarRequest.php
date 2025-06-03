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
        'province',
        'requester_phone', 
        'seats',
        'car_registration',
        'driver',
        'driver_phone',
        'reason',
        'status',
        'purpose',
        'car_name',
        'meeting_datetime',
        'car_request_time',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver');
    }
}
