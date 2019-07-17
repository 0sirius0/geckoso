<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    //
    protected $table='rentals';

    protected $fillable =[
        'book_id', 'student_id', 'isRecieve',
    ];

    public function book(){
        return $this->hasOne('App\Book', 'id', 'book_id');
    }

    public function student(){
        return $this->hasOne('App\Student', 'id', 'student_id');
    }
}
