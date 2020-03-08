<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WakatimeUrl;
use App\Models\WakatimeTracking;
use Carbon\Carbon;

use Auth;
use Curl;
use DB;

class WakatimeController extends Controller
{
    
    public function report()
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek   = now()->endOfWeek();

        $userId   = Auth::user()->id;
        $wakatime = WakatimeTracking::where('user_id', $userId)->whereBetween('date', [$startOfWeek, $endOfWeek])->get();
        $lastData = $wakatime->last();
        
        $codingActivity = [];
        foreach ($wakatime as $item) {
            $codingActivity[] = number_format($item->hours + ($item->minutes / 60), 2, '.', '');
        }

        $languages = collect(json_decode($lastData->languages));
        $editors   = collect(json_decode($lastData->editors));
        
        $report = (object) [
            'codingActivity' => json_encode($codingActivity),
            'languages' => $languages,
            'editors' => $editors
        ];

        return view('pages.wakatime.report-santri', compact('report'));
    }

    public function url()
    {
        $userId   = Auth::user()->id;
        $wakatime = WakatimeUrl::where('user_id', $userId)->first();
        
        return view('pages.wakatime.url', compact('wakatime'));
    }

    public function update(Request $request, WakatimeUrl $wakatime)
    {
        if (!$request->ajax()) abort(404);

        $request->validate([
            'coding_activity' => 'required',
            'languages'       => 'required',
            'editors'         => 'required'
        ]);

        $data = $request->all();
        $data['status'] = false;

        try {
            $wakatime->update($data);
            return $this->success('Successfuly update data wakatime!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

}
