<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\WakatimeTracking;
use App\Models\WakatimeUrl;
use App\Models\User;

use Carbon\Carbon;

use Auth;
use Curl;
use DB;

class WakatimeController extends Controller
{
    public function index(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $users = User::where(function ($query) use ($request, $branchId) {
            if (!is_null($branchId)) {
                $query->where('branch_id', $branchId);
            }

            if (!is_null($request->keyword)) {
                $query->where('name', 'like', "%$request->keyword%")
                    ->orWhere('username', 'like', "%$request->keyword%")
                    ->orWhere('email', 'like', "%$request->keyword%");
            }
        })->where('role_id', 9)->paginate($request->showitem ?? 5);
        
        $users->appends($request->query());

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.wakatime.' . $view, compact('users'));
    }

    public function indexurl(Request $request)
    {
        $branchId = Auth::user()->branch_id;
        
        $users = WakatimeUrl::select('wakatime_urls.id', 'users.name', 'wakatime_urls.coding_activity', 'wakatime_urls.languages', 'wakatime_urls.editors', 'wakatime_urls.status')
        ->leftJoin('users', 'wakatime_urls.user_id', '=', 'users.id')
        ->where(function ($query) use ($branchId) {
            if (!is_null($branchId)) {
                $query->where('users.branch_id', $branchId);
            }
        })->paginate($request->showitem ?? 5);

        $users->appends($request->query());

        $view = $request->ajax() ? 'list-url' : 'index-url';

        return view('pages.wakatime.' . $view, compact('users'));
    }

    public function status(WakatimeUrl $wakatime)
    {
        try {
            $wakatime->update([
                'status' => ($wakatime->status == 1) ? 0 : 1
            ]);
            return $this->success('Successfuly verified wakatime url!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
    
    public function report(int $userid = null)
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek   = now()->endOfWeek();

        $userId   = $userid ?? Auth::user()->id;
        $wakatime = WakatimeTracking::where('user_id', $userId)->whereBetween('date', [$startOfWeek, $endOfWeek])->get();
        $lastData = $wakatime->last();
        
        $codingActivity = [];
        foreach ($wakatime as $item) {
            $codingActivity[] = number_format($item->hours + ($item->minutes / 60), 2, '.', '');
        }

        if (!is_null($lastData)) {
            $languages = collect(json_decode($lastData->languages));
            $editors   = collect(json_decode($lastData->editors));
            
            $languages = (object) [
                'name'    => $languages->pluck('name')->toArray(),
                'percent' => $languages->pluck('percent')->toArray()
            ];
            $editors = (object) [
                'name'    => $editors->pluck('name')->toArray(),
                'percent' => $editors->pluck('percent')->toArray()
            ];
        } else {
            $languages = (object) [
                'name'    => [],
                'percent' => []
            ];
            $editors = (object) [
                'name'    => [],
                'percent' => []
            ];
        }
        
        $report = (object) [
            'codingActivity' => json_encode($codingActivity),
            'languages' => (object) [
                'name' => json_encode($languages->name),
                'percent' => json_encode($languages->percent)
            ],
            'editors' => (object) [
                'name' => json_encode($editors->name),
                'percent' => json_encode($editors->percent)
            ]
        ];

        $startOfWeek = date('d F Y', strtotime($startOfWeek));
        $endOfWeek   = date('d F Y', strtotime($endOfWeek));

        return view('pages.wakatime.report', compact('report', 'startOfWeek', 'endOfWeek'));
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
