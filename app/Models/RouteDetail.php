<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class RouteDetail extends Model
{
    public $table = 'route_detail';
    use HasFactory, Uuid, SoftDeletes;
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'route_id','id','customer_id'
    ];
}
