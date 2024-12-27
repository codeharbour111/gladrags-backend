<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    public $table = 'order_status_history';

    protected $fillable = 
    [
        'user_id',
        'order_id',
        'status'
    ];

    protected $hidden = 
    [
        'created_at',
        'updated_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
