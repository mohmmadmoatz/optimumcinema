<?php

function getcategoryname($value,$cats){

    $splitedcat = explode(",",$value);
    
    $cat_in_string =array();
    
    foreach($splitedcat as $cat){
      $findcat=$cats->find($cat);
      if($findcat){
         $cat_in_string[] =  $findcat->name;
      }
     
    }
    
    return implode(" ",$cat_in_string);
    
    }

?>