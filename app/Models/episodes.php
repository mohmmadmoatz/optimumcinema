<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class episodes extends Model
{
    //
    protected $guarded = [];  
    protected $table = "series_epi";

    public function getSubtitleAttribute($value)
    {
        $newip = str_replace("93.191.114.168",$_SERVER['SERVER_ADDR'],$value);
        $newip = str_replace("212.23.217.75",$_SERVER['SERVER_ADDR'],$newip);
        return $newip;
    }

    public function getUrlAttribute($value)
    {
        $newip = str_replace("93.191.114.168",$_SERVER['SERVER_ADDR'],$value);
        $newip = str_replace("212.23.217.75",$_SERVER['SERVER_ADDR'],$newip);
       // return "";

        return $newip;
    }
}