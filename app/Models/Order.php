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
        'customer_name',
        'customer_email',
        'customer_phone_no',
        'customer_address',
        'delivery_date',
        'total_price'
    ];

    protected $hidden = 
    [
        'created_at',
        'updated_at'
    ];

    public function items()
    {
        $this->hasMany(OrderItem::class,'order_id');
    }

    protected static function booted(): void
    {
        //dd('Inside boot');
        static::created(function (Order $order)
        {
            $order->order_number = 'GR-' . str_pad($order->id, 7, "0", STR_PAD_LEFT);
            $order->save();
            dd('Boot Complete');
        });
    }
}
