<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name',
        'image',
        'sizes'
    ];

    public function setSizesAttribute($value)
    {
        $this->attributes['sizes'] = json_encode($value);
    }

    public function getSizesAttribute($value)
    {
        return json_decode($value, true);
    }


    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
