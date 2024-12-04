<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "product";

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'has_discount',
        'discount_price',
        'discount_date',
        'color',
        'sku'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // public static function boot()
    // {
    //        parent::boot();
    //        self::created(function ($model) {
    //            //$model->transaction_id = 'NMB-BOO-' . str_pad($model->id, 7, "0", STR_PAD_LEFT);
    //            //$model->save();
    //        });
    // }

    public function category()
    {
        return $this->belongsTo(Categories::class,'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function inventory()
    {
        $this->hasMany(Inventory::class, 'product_id');
    }
}
