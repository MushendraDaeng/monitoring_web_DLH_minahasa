<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Tracking extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'driver_id',
        'truck_id',
        'route_id',
        'act_date',
        // 'start_time',
        // 'stop_time',
        // 'start_location',
        // 'stop_location'
    ];

}