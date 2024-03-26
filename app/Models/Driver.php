<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use HasApiTokens,Notifiable;
    use HasFactory, Uuid, SoftDeletes;
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'user_name',
        'name',
        'password',
        'phone',
        'photo',
        'gender',
        'dob'
    ];
    protected $hidden = [
        'password'
    ];
}