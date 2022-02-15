<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slideshow extends Model
{
    //
    protected $table = "slideshow";
  
    public function getUrlAttribute($value)
    {
        $newip = str_replace("93.191.114.168",$_SERVER['SERVER_ADDR'],$value);
        $newip = str_replace("10.24.24.206",$_SERVER['SERVER_ADDR'],$newip);
        return $newip;
    }

    public function getAppurlAttribute($value)
    {
        $newip = str_replace("93.191.114.168",$_SERVER['SERVER_ADDR'],$value);
        $newip = str_replace("10.24.24.206",$_SERVER['SERVER_ADDR'],$newip);

        return $newip;
    }

    public function getLinkAttribute($value)
    {
        $newip = str_replace("93.191.114.168",$_SERVER['SERVER_ADDR'],$value);
        $newip = str_replace("10.24.24.206",$_SERVER['SERVER_ADDR'],$newip);

        return $newip;
    }

}
