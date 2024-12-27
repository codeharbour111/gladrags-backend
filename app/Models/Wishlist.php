<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public $table = 'wishlist';

    protected $fillable = 
    [
        'user_id',
        'product_id'
    ];

    protected $hidden = 
    [
        'created_at',
        'updated_at'
    ];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'product_id');
    // }
}
