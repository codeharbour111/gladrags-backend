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
        'eligible_price',
        'expire_date'
    ];

    protected $hidden = 
    [
        'created_at',
        'updated_at'
    ];
}
