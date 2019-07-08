<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rentals extends Model
{
    //
    protected $table = 'rentals';

    protected $fillable = ['book_id', 'student_name', 'student_class', 'isRecieve'];

    public $timestamps = true;

    protected $appends = ['book_code','book_name'];

}
