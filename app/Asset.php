<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'region', 'name', 'cover_image'
    ];

    /**
     * Get the category of the asset.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the categories of the asset.
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * Get the files for the asset.
     */
    public function assetfiles()
    {
        return $this->hasMany('App\AssetFile');
    }

     /**
     * The users that belong to the asset.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Scope a query to filter.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $input)
    {
        if (empty($input)) {
            return $query;
        }

        // Category filter
        if (!empty($input['category'])) {
            /*$query->whereExists(function ($query) use ($input) {
                $query->select(DB::raw(1))
                      ->from('asset_category')
                      ->whereRaw('asset_category.asset_id = assets.id')
                      ->where('asset_category.category_id', $input['category']);
            });*/
            // Same as above but more succinct
            $query->whereHas('categories', function ($q) use ($input) {
                $q->where('categories.id', $input['category']);
            });
        }

        return $query;
    }

    /**
     * Scope a query to search.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $input)
    {
        if (empty($input)) {
            return $query;
        }

        // Name search
        if (!empty($input['search'])) {
            $query->where(function ($query) use ($input) {
                // Actual Asset name
                $query->where('name', 'like', '%' . $input['search'] . '%')
                    // Include Asset File names
                    ->orWhereExists(function ($query) use ($input) {
                        $query->select(DB::raw(1))
                              ->from('asset_files')
                              ->whereRaw('asset_files.asset_id = assets.id')
                              ->where('asset_files.filename', 'like', '%' . $input['search'] . '%');
                    });
            });
        }

        return $query;
    }

    /**
     * Scope a query to either paginate or return all Assets
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  boolean $paginate
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function scopeAllOrPaginate($query, $paginate = false)
    {
        if (! $paginate) {
            return $query->get();
        }

        return $query->paginate();
    }

    /**
     * Scope a query to restrict Asset access based on specific User restrictions
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  integer $userId
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function scopeRestrict($query, $userId)
    {
        return $query->whereNotExists(function ($query) use ($userId) {
            $query->select(DB::raw(1))
                  ->from('asset_user')
                  ->whereRaw('asset_user.asset_id = assets.id')
                  ->where('asset_user.user_id', $userId);
        });
    }

    /**
     * Get category names (with parent if present)
     *
     * @return string
     */
    public function getCategoryNamesAttribute()
    {
        return $this->categories->map(function ($item) {
            return $item->name_with_parent;
        })->implode(', ');
    }
}
