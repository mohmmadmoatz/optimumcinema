<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class series extends Model
{
    //
    protected $guarded = [];  
   
    public function getPosterAttribute($value)
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