<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    //
    protected $table = 'books';

    protected $fillable = ['name', 'kind_id'];

    public $timestamps = false;

    protected $appends = ['kind'];
}
