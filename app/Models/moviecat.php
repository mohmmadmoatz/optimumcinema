<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class moviecat extends Model
{
    //
    public function getPosterAttribute($value)
    {
        $newip = str_replace("93.191.114.168",$_SERVER['SERVER_ADDR'],$value);
        return $newip;
    }
    public function movies(){
         return $this->hasMany('App\movies');
    }
}
