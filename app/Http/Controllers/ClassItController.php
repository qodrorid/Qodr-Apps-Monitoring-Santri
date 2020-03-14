<?php

namespace App\Http\Controllers;

use App\Models\ClassIt;
use Illuminate\Http\Request;

class ClassItController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classit = ClassIt::where(function($query) use ($request) {
            if (!is_null($request->keyword)) {
                $query->where('title', 'like', "%$request->keyword%")
                    ->orWhere('description', 'like', "%$request->keyword%")
                    ->orWhere('mentor', 'like', "%$request->keyword%");
            }
        })->paginate($request->showitem ?? 5);

        $classit->appends($request->query());

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.classit.' . $view, compact('classit'));
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
            ClassIt::create($data);
            return $this->success('Successfuly create new class it!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassIt  $classit
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassIt $classit)
    {
        $data = $classit->toArray();
        $data['participant'] = json_decode($data['participant']);
        return $this->success('Successfuly get data class it!', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassIt  $classit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassIt $classit)
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
            $classit->update($data);
            return $this->success('Successfuly update data class it!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassIt  $classit
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassIt $classit)
    {
        try {
            $classit->delete();
            return $this->success('Successfuly delete class it!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
}
