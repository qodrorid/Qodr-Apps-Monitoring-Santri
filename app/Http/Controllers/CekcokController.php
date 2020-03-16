<?php

namespace App\Http\Controllers;

use App\Models\Cekcok;
use Illuminate\Http\Request;

class CekcokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cekcok = Cekcok::where(function($query) use ($request) {
            if (!is_null($request->keyword)) {
                $query->where('title', 'like', "%$request->keyword%")
                    ->orWhere('description', 'like', "%$request->keyword%")
                    ->orWhere('mentor', 'like', "%$request->keyword%");
            }
        })->paginate($request->showitem ?? 5);

        $cekcok->appends($request->query());

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.cekcok.' . $view, compact('cekcok'));
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
            'title'       => 'required',
            'description' => 'required',
            'mentor'      => 'required',
            'participant' => 'required',
            'start_time'  => 'required'
        ]);

        $data = $request->except(['participant']);

        $data['participant'] = is_array($request->participant) ? json_encode($request->participant) : json_encode([$request->participant]);

        try {
            Cekcok::create($data);
            return $this->success('Successfuly create new cekcok!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cekcok  $cekcok
     * @return \Illuminate\Http\Response
     */
    public function edit(Cekcok $cekcok)
    {
        $data = $cekcok->toArray();
        $data['participant'] = json_decode($data['participant']);
        return $this->success('Successfuly get data cekcok!', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cekcok  $cekcok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cekcok $cekcok)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'mentor'      => 'required',
            'participant' => 'required',
            'start_time'  => 'required'
        ]);

        $data = $request->except(['participant']);

        $data['participant'] = is_array($request->participant) ? json_encode($request->participant) : json_encode([$request->participant]);
        
        try {
            $cekcok->update($data);
            return $this->success('Successfuly update data cekcok!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cekcok  $cekcok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cekcok $cekcok)
    {
        try {
            $cekcok->delete();
            return $this->success('Successfuly delete cekcok!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
}
