<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetFile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'filename'
    ];

    /**
     * Get the asset that owns the file.
     */
    public function asset()
    {
        return $this->belongsTo('App\Asset');
    }
}
