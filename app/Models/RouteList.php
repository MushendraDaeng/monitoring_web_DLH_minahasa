<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class RouteList extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'name','description'
    ];
}