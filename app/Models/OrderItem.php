<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $table = 'order_item';

    protected $fillable = [
        'order_id',
        'product_id',
        'size',
        'price',
        'quantity',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
