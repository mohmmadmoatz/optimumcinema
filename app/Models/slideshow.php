<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slideshow extends Model
{
    //
    protected $table = "slideshow";
  
    public function getUrlAttribute($value)
    {
        $result = parse_url($value);
        $ip = $result['host'];
        $newip = str_replace($ip,$_SERVER['SERVER_ADDR'],$value);
        
        return $newip;
    }

    public function getAppurlAttribute($value)
    {
        $result = parse_url($value);
        $ip = $result['host'];
        $newip = str_replace($ip,$_SERVER['SERVER_ADDR'],$value);
        
        return $newip;
    }

    public function getLinkAttribute($value)
    {
        $result = parse_url($value);
        $ip = $result['host'];
        $newip = str_replace($ip,$_SERVER['SERVER_ADDR'],$value);
        
        return $newip;
    }

}
