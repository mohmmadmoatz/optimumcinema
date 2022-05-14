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
        $result = parse_url($value);
        $ip = $result['host'];
        $newip = str_replace($ip,$_SERVER['SERVER_ADDR'],$value);
        
        return $newip;
    }

    public function getUrlAttribute($value)
    {
        $result = parse_url($value);
        $ip = $result['host'];
        $newip = str_replace($ip,$_SERVER['SERVER_ADDR'],$value);
        
        return $newip;

      
    }
}