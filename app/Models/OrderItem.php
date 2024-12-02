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

    public function order()
    {
        $this->belongsTo(Order::class,'order_id');
    }
    //
}
