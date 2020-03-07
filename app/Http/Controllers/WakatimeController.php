<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WakatimeUrl;
use Curl;
use Auth;

class WakatimeController extends Controller
{
    
    public function report()
    {
        // $urlWakatime = 'https://wakatime.com/share/@theger09/79cb0cfb-8f7e-4644-8be5-b68a484abfb3.json';
        // $response    = Curl::to($urlWakatime)->asJson()->get();

        // dd(date('Y-m-d H:i:s', strtotime($response->data[0]->range->start)));
        // dd($response->data);
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
