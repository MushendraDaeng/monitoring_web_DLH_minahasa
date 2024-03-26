<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Uuid;

class SubscriptionReport extends Model
{
    use HasFactory, Uuid, SoftDeletes;
    public $incrementing = false;
    public $timestamps = true;
    protected $fillable = [
        'customer_id',
        'total_payment',
        'payment_date',
    ];
}