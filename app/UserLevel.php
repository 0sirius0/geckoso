<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    //
    protected $table = 'user_levels';
    protected $fillable = [
        'name', 'priority',
    ];

    public $timestamps = false;
}
