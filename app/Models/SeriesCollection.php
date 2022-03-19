<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesCollection extends Model
{
    use HasFactory;

    /**
     * Get all of the serieses for the SeriesCollection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serieses()
    {
        return $this->hasMany(series::class, 'collection_id');
    }
}
