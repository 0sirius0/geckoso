<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookKind extends Model
{
    //
    protected $table = 'book_kinds';

    protected $fillable = [
        'name', 'kind_code', 'isActive'
    ];

    public $timestamps = false;
}
