<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieFav extends Model
{
    use HasFactory;

    protected $withs=["movie"];

    /**
     * Get the movie that owns the MovieFav
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie()
    {
        return $this->belongsTo(movies::class, 'movie_id');
    }   
}
