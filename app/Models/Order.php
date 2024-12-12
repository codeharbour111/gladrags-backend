<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'order';

    protected $fillable = 
    [
        'status',
        'user_id',
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone_no',
        'customer_address',
        'location',
        'discount_code',
        'discount',
        'delivery_date',
        'total_quantity',
        'subtotal',
        'shipping_fee',
        'total_price'
    ];

    protected $hidden = 
    [
        'created_at',
        'updated_at'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id');
    }

    protected static function booted(): void
    {
        //dd('Inside boot');
        static::created(function (Order $order)
        {
            $order->order_number = 'GR-' . str_pad($order->id, 7, "0", STR_PAD_LEFT);
            $order->save();
            //dd('Boot Complete');
        });
    }
}
