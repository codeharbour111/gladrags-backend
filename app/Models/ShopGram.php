<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopGram extends Model
{
    public $table = 'shop_gram';

    protected $fillable = [
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
