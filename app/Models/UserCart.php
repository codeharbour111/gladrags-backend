<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCart extends Model
{
    public $table = 'user_cart';

    protected $fillable = 
    [
        'user_id',
        'carts',
    ];

    protected $hidden = 
    [
        'created_at',
        'updated_at'
    ];
}
