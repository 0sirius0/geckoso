<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $table = 'students';

    protected $fillable = [
        'fullname', 'class_id', 'isActive',
    ];

    public $timestamps = false;

    public function class(){
        return $this->hasOne('App\StudentClass', 'id', 'class_id');
    }
}
