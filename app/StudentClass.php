<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    //
    protected $table = 'classes';

    protected $fillable =['name', 'isActive'];

    public $timestamps = false;
}
