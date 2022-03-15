<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
       protected $table="comment"; 

    protected $appends=['item_name'];

       /**
        * Get the user that owns the Comment
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
        */
       public function user()
       {
           return $this->belongsTo(User::class);
       }

       public function getItemNameAttribute()
       {
           if($this->type =="movie"){
              return movies::find($this->movie_id)->name ??"";
           }else{
              return series::find($this->movie_id)->name ??"";

           }
          
       }
       
}
