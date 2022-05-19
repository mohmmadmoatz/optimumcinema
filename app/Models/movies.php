<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class movies extends Model
{
    //

  

    

    

    public function getPosterAttribute($value)
    {
        $result = parse_url($value);
        $ip = $result['host'] ?? "";
        $newip = str_replace($ip,$_SERVER['SERVER_ADDR'],$value);
        
        return $newip;
    }

    public function getUrlAttribute($value)
    {
        $result = parse_url($value);
        $ip = $result['host'] ?? "";
        $newip = str_replace($ip,$_SERVER['SERVER_ADDR'],$value);
        
        return $newip;
        
    }
    public function getVvtAttribute($value)
    {
        $result = parse_url($value);
        $ip = $result['host'] ?? "";
        $newip = str_replace($ip,$_SERVER['SERVER_ADDR'],$value);
        
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
