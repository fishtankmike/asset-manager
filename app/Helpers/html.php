<?php

use Illuminate\Support\Facades\Cache;
// use Illuminate\Contracts\Cache\Repository as Cache;

if (! function_exists('recursive_list')) {
    /**
     * Generate a recursive list of items that have children
     *
     * @param  Illuminate\Database\Eloquent\Collection $items
     * @return string
     */
    function recursive_list($items, $admin, $top = false)
    {
        if ($top && Cache::has('recursive_list')) {
            return Cache::get('recursive_list');
        }

        $html = '';

        foreach ($items as $item) {
            $hasChildren = count($item->children);
            $html .= '<li class="site-menu-item' . (($hasChildren) ? ' has-sub is-shown' : '') . '">';
            if ($hasChildren) {
                $html .= '<a href="javascript:void(0)">' . $item->name . '<span class="site-menu-arrow"></span></a>';
                $html .= '<ul class="site-menu-sub">';
                $html .= recursive_list($item->children, $admin, false);
                $html .= '</ul>';
            } else {

                $html .= '<a href="' . (($admin) ? url('admin/assets?category=' . $item->id) : url('assets?category=' . $item->id)) . '">' . $item->name . '</a>';
            }
            $html .= '</li>';
        }

        if ($top) {
            Cache::forever('recursive_list', $html);
        }

        return $html;
    }
}

if (! function_exists('cat_select_options')) {
    /**
     * Generate a recursive list of items that have children
     *
     * @param  Illuminate\Database\Eloquent\Collection $items
     * @return string
     */
    function cat_select_options($items)
    {
        // if ($top && Cache::has('recursive_list')) {
        //     return Cache::get('recursive_list');
        // }

        $html = '';

        foreach ($items as $item) {
            // $html  .= '<option value="">'.$item->name.'</option>';
            $hasChildren = count($item->children);
            if ($hasChildren) {
                $html .= '<optgroup label="'.$item->name.'">';
                $html .= cat_select_options($item->children);
                $html .= '</optgroup>';
            } else {
                $html .= '<option value="">'.$item->name.'</option>';
            }

            //     $html .= '<a href="javascript:void(0)">' . $item->name . '<span class="site-menu-arrow"></span></a>';
            //     $html .= '<ul class="site-menu-sub">';
            //     $html .= recursive_list($item->children, $admin, false);
            // //     $html .= '</ul>';
            // } else {
            // //
            // //     $html .= '<a href="' . (($admin) ? url('admin/assets?category=' . $item->id) : url('assets?category=' . $item->id)) . '">' . $item->name . '</a>';
            // }
            // $html .= '</li>';
        }

    return $html;
    }
}
