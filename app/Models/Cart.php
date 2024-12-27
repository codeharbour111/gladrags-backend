<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $table = 'cart';

    protected $fillable = 
    [
        'user_id',
        'product_id',
        'size',
        'quantity',
        'price',
        'total'
    ];

    protected $hidden = 
    [
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
