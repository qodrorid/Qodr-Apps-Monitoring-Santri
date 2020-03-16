<?php

namespace App\Utils;

use DB;
use Auth;

class HelperTag
{

    public static function showItem(int $selected = 5)
    {
        $result = '';
        $data   = [5, 10, 25, 50, 100];
        foreach ($data as $value) {
            $result .= '<option value="' . $value . '" ' . ($selected === $value ? 'selected' : '') . '>' . $value . '</option>';
        }

        return $result;
    }
    
    public static function roleSelect($selected = null)
    {
        $result = '';
        $roles = DB::table('roles')->select('id', 'name')->where('id', '!=', 1)->get();
        foreach ($roles as $role) {
            $result .= '<option value="' . $role->id . '" ' . ($selected === $role->id ? 'selected' : '') . '>' . $role->name . '</option>';
        }
        
        return $result;
    }
    
    public static function branchSelect($selected = null)
    {
        $result = '';
        $branches = DB::table('branches')->select('id', 'name')->whereNull('deleted_at')->get();
        foreach ($branches as $branch) {
            $result .= '<option value="' . $branch->id . '" ' . ($selected === $branch->id ? 'selected' : '') . '>' . $branch->name . '</option>';
        }
        
        return $result;
    }
    
    public static function userSelect($selected = null, $fieldKey = 'id')
    {
        $branchId = Auth::user()->branch_id;
        $result = '';
        $users = DB::table('users')->select('name')->where('branch_id', $branchId)->where('role_id', 9)->whereNull('deleted_at')->get();
        foreach ($users as $user) {
            $result .= '<option value="' . $user->$fieldKey . '" ' . ($selected === $user->$fieldKey ? 'selected' : '') . '>' . $user->name . '</option>';
        }
        
        return $result;
    }

    public static function rab($selected = null)
    {
        $branchId = Auth::user()->branch_id;
        $result = '';
        $rabs = DB::table('rabs')->select('id', 'month', DB::raw("CONCAT(`month`, ' ', `year`) as name"))->where('branch_id', $branchId)->orderBy('date', 'desc')->get();
        foreach ($rabs as $rab) {
            $result .= '<option value="' . $rab->id . '" ' . (($selected === $rab->id or date('F') === $rab->month) ? 'selected' : '') . '>' . $rab->name . '</option>';
        }
        
        return $result;
    }

}