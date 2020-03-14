<?php

namespace App\Http\Controllers;

use App\Models\EventIt;
use Illuminate\Http\Request;

class EventItController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $eventit = EventIt::where(function($query) use ($request) {
            if (!is_null($request->keyword)) {
                $query->where('title', 'like', "%$request->keyword%")
                    ->orWhere('description', 'like', "%$request->keyword%");
            }
        })->paginate($request->showitem ?? 5);

        $eventit->appends($request->query());

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.eventit.' . $view, compact('eventit'));
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
            'participant' => 'required',
            'start'       => 'required',
            'end'         => 'required',
            'budget'      => 'required'
        ]);

        $data = $request->except(['participant']);

        $data['participant'] = is_array($request->participant) ? json_encode($request->participant) : json_encode([$request->participant]);

        try {
            EventIt::create($data);
            return $this->success('Successfuly create new event it!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventIt  $eventit
     * @return \Illuminate\Http\Response
     */
    public function edit(EventIt $eventit)
    {
        $data = $eventit->toArray();
        $data['participant'] = json_decode($data['participant']);
        return $this->success('Successfuly get data event it!', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventIt  $eventit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventIt $eventit)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'participant' => 'required',
            'start'       => 'required',
            'end'         => 'required',
            'budget'      => 'required'
        ]);

        $data = $request->except(['participant']);

        $data['participant'] = is_array($request->participant) ? json_encode($request->participant) : json_encode([$request->participant]);
        
        try {
            $eventit->update($data);
            return $this->success('Successfuly update data event it!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventIt  $eventit
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventIt $eventit)
    {
        try {
            $eventit->delete();
            return $this->success('Successfuly delete event it!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
}
