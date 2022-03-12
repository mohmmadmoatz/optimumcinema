<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $guarded=[];

    /**
     * Get the movie that owns the History
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function movie()
    {
        return $this->belongsTo(movies::class, 'model_id');
    }

    public function series()
    {
        return $this->belongsTo(series::class, 'model_id');
    }
}
