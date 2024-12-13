<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class GladragsUser extends Authenticatable
{
    use Notifiable;

    protected $guard = 'gladrags_user';

    protected $fillable = [
        'name', 'email', 'password', 'name', 'phone_no', 'city', 'address'
    ];

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

}
    // app/Writer.php
?>
