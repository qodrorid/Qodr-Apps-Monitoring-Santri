<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\WakatimeTracking;

use Auth;

class WakatimeController extends Controller
{
    
    public function dashboard()
    {
        $date   = date('Y-m-d');
        $userId = Auth::user()->id;

        $wakatime  = WakatimeTracking::where('user_id', $userId)->where('date', $date)->first();

        $timeText  = $wakatime->text_duration;
        $languages = '';
        $editors   = '';
        
        foreach (json_decode($wakatime->languages) as $key => $value) {
            $languages .= $value->name. ', ';
            if($key == 1) break;
        }
        
        foreach (json_decode($wakatime->editors) as $key => $value) {
            $editors .= $value->name. ', ';
            if($key == 1) break;
        }

        $data = [
            'timeText'  => $timeText,
            'languages' => $languages . 'more ...',
            'editors'   => $editors . 'more ...'
        ];

        return $this->success('Success!', $data);
    }

}