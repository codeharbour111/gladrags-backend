<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $table = 'coupon';

    protected $fillable = 
    [
        'code',
        'discount',
        'discount_amount',
        'expire_date'
    ];

    protected $hidden = 
    [
        'created_at',
        'updated_at'
    ];
}
