<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $table = 'books';

    protected $fillable = [
        'name', 'kind_id', 'code', 'amount', 'isAcive',
    ];

    public $timestamps = false;

    public function book_kind(){
        return $this->hasOne('App\BookKind', 'id', 'kind_id');
    }
}
