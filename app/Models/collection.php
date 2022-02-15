<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    //
    protected $table = "collection";
  
    public function movies(){
        return $this->hasMany('App\Models\movies','moviecollection','id');
    }
}
