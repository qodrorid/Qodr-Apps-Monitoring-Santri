<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $settings = Setting::where(function($query) use ($request) {
            if (!is_null($request->keyword)) {
                $query->where('name', 'like', "%$request->keyword%")
                    ->orWhere('setting', 'like', "%$request->keyword%");
            }
        })->paginate($request->showitem ?? 5);

        $settings->appends($request->query());

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.settings.' . $view, compact('settings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'setting' => 'required'
        ]);

        $data = $request->all();

        try {
            Setting::create($data);
            return $this->success('Successfuly create new setting!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return $this->success('Successfuly get data setting!', $setting);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'name'    => 'required',
            'setting' => 'required'
        ]);
        
        try {
            $setting->update($request->all());
            return $this->success('Successfuly update data setting!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        try {
            $setting->delete();
            return $this->success('Successfuly delete setting!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
}
