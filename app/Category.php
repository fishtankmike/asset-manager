<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name'
    ];

    /**
     * Get the assets for the category.
     */
    public function assets()
    {
        return $this->belongsToMany('App\Asset');
    }

    /**
     * Get the parent for the category.
     */
    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    /**
     * Get the childen for the category.
     */
    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id')->orderBy('name');
    }

    /**
     * Get the list of categories with children
     *
     * @return array
     */
    public static function getList()
    {
        if (Cache::has('CategoryGetList')) {
            return Cache::get('CategoryGetList');
        }

        $topLevel = self::with('children')
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        $list = [];
        foreach ($topLevel as $topLevelCategory) {
            $list[$topLevelCategory->id] = $topLevelCategory->name;

            $list += $topLevelCategory->getChildren($topLevelCategory->children, $topLevelCategory->name);
        }

        Cache::forever('CategoryGetList', $list);

        return $list;
    }

    /**
     * Get recursive children
     *
     * @param  Illuminate\Database\Eloquent\Collection $children
     * @param  string $parent
     * @return array
     */
    public function getChildren($children, $parent)
    {
        $list = [];

        if (count($children)) {
            foreach ($children as $child) {
                $list[$child->id] = $parent . ' -> ' . $child->name;

                $list += $child->getChildren($child->children, $parent . ' -> ' . $child->name);
            }
        }

        return $list;
    }

    /**
     * Get category name (with parent if present)
     *
     * @return string
     */
    public function getNameWithParentAttribute()
    {
        return count($this->parent) ? $this->parent->name_with_parent . ' / ' . $this->name : $this->name;
    }
}
