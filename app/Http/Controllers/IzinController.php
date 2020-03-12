<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;

use Auth;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $izin = Izin::where(function($query) use ($request) {
            if (!is_null($request->start) and !is_null($request->end)) {
                $query->whereBetween('start', [$request->start, $request->end])
                    ->orWhereBetween('end', [$request->start, $request->end]);
            }
            if (!is_null($request->keyword)) {
                $query->where('name', 'like', "%$request->keyword%")
                    ->orWhere('information', 'like', "%$request->keyword%");
            }
        })->paginate($request->showitem ?? 5);

        $izin->appends($request->query());

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.izin.' . $view, compact('izin'));
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
            'information' => 'required',
            'start'       => 'required',
            'end'         => 'required'
        ]);

        $user = Auth::user();

        $data = $request->all();
        
        $data['user_id'] = $user->id;
        $data['name']    = $user->name;

        try {
            Izin::create($data);
            return $this->success('Successfuly create new izin!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function edit(Izin $izin)
    {
        return $this->success('Successfuly get data izin!', $izin);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Izin $izin)
    {
        $request->validate([
            'information' => 'required',
            'start'       => 'required',
            'end'         => 'required'
        ]);

        if ($izin->approved) abort(400);
        
        try {
            $izin->update($request->all());
            return $this->success('Successfuly update data izin!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Izin  $izin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Izin $izin)
    {
        try {
            $izin->delete();
            return $this->success('Successfuly delete izin!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
}
