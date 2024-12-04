<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $table = 'banner';

    protected $fillable = 
    [
        'title',
        'subtitle',
        'image'
    ];

    protected $hidden = 
    [
        'created_at',
        'updated_at'
    ];
}
