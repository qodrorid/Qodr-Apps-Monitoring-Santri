<?php

namespace App\Utils;

use Auth;
use Storage;
use Route;
use DB;

class HelperView
{
    
    /**
     * view menu
     *
     * @param [array | null] $childs
     * @return string
     */
    public static function menu($childs = null)
    {
        $result = '';

        if (is_null($childs)) {
            $role    = Auth::user()->role_id;
            $storage = Storage::disk('local')->get('settings/menus/' . $role . '.json');
            $menus   = json_decode($storage);
        } else {
            $menus = $childs;
        }

        foreach ($menus as $menu) {
            if (!empty($menu->route)) {
                $class = self::menuActive($menu->route);
            } else if (!empty($menu->childs)) {
                $class  = 'pcoded-hasmenu ';
                $class .= self::menuActive(array_column($menu->childs, 'route'), 'active pcoded-trigger');
            } else {
                $class = '';
            }

            if (!empty($menu->level)) {
                $result .= '<div class="pcoded-navigatio-lavel">' . $menu->title . '</div>';
            } else {
                $result .= '<li class="' . $class . '">';
                $result .= '<a href="' . (!empty($menu->route) ? route($menu->route) : 'javascript:void(0)') . '">';
                $result .= (!empty($menu->parent)) ? '<span class="pcoded-micon"><i class="feather ' . ($menu->icon ?? 'icon-chevron-right') . '"></i></span>' : '';
                $result .= '<span class="pcoded-mtext">' . $menu->title . '</span></a>';
            }
            
            if (!empty($menu->level)) {
                $result .= '<ul class="pcoded-item pcoded-left-item">';
                $result .= self::menu($menu->childs);
                $result .= '</ul>';
            } elseif(!empty($menu->childs)) {
                $result .= '<ul class="pcoded-submenu">';
                $result .= self::menu($menu->childs);
                $result .= '</ul>';
            }
            
            $result .= '</li>';
        }
        
        return $result;
    }

    /**
     * Menu Active
     *
     * @param [array | string] $routes
     * @param string $class
     * @return string
     */
    private static function menuActive($routes, $class = 'active')
    {
        if (is_array($routes)) {
            foreach ($routes as $route) {
                if (Route::is($route)) return $class;
            }
            return '';
        } else {
            return Route::is($routes) ? $class : '';
        }
    }

    /**
     * Color Lable Role
     *
     * @param int $role
     * @return string
     */
    public static function labelRole(int $role)
    {
        switch ($role) {
            case 1:
                return 'bg-inverse';
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
                return 'bg-primary';
            case 8:
                return 'bg-danger';
            case 9:
                return 'bg-warning';
        }
    }

}
