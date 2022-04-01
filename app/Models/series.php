<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class series extends Model
{
    //
    protected $guarded = [];  
   
    public function getPosterAttribute($value)
    {
        $newip = str_replace("93.191.114.168",$_SERVER['SERVER_ADDR'],$value);
        $newip = str_replace("10.24.24.206",$_SERVER['SERVER_ADDR'],$newip);
        $newip = str_replace("212.23.217.75",$_SERVER['SERVER_ADDR'],$newip);
        return $newip;
    }

    public function getSkiptimeAttribute($value)
    {
        if(!$value){
            return "";
        }
        return $value;
    }

}