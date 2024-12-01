<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $table = "inventory";

    protected $fillable =
    [
        'product_id',
        'size',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
