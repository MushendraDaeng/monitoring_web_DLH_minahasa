<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class Customer extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'id_kategori',
        'id_sub_kategori',
        'name',
        'urban_village',
        'sub_district',
        'status',
        'tarif',
        'latitude',
        'longitude',
    ];
}