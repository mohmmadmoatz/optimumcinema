<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class movies extends Model
{
    //

  

    

    

    public function getPosterAttribute($value)
    {
        $newip = str_replace("93.191.114.168",$_SERVER['SERVER_ADDR'],$value);
        $newip = str_replace("10.24.24.206",$_SERVER['SERVER_ADDR'],$newip);

        return $newip;
    }

    public function getUrlAttribute($value)
    {
        $newip = str_replace("93.191.114.168",$_SERVER['SERVER_ADDR'],$value);
        $newip = str_replace("10.24.24.206",$_SERVER['SERVER_ADDR'],$newip);

        // return $newip;
         return "";
    }
    public function getVvtAttribute($value)
    {
        $newip = str_replace("93.191.114.168",$_SERVER['SERVER_ADDR'],$value);
        $newip = str_replace("10.24.24.206",$_SERVER['SERVER_ADDR'],$newip);

        return $newip;
    }
    
}
