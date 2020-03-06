<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branch = Branch::where(function($query) use ($request) {
            if (!is_null($request->keyword)) {
                $query->where('name', 'like', "%$request->keyword%");
            }
        })->paginate($request->showitem ?? 5);

        $branch->appends($request->query());

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.branch.' . $view, compact('branch'));
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
            'name' => 'required'
        ]);

        $data = $request->all();

        try {
            Branch::create($data);
            return $this->success('Successfuly create new branch!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        return $this->success('Successfuly get data branch!', $branch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required'
        ]);
        
        try {
            $branch->update($request->all());
            return $this->success('Successfuly update data branch!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        try {
            $branch->delete();
            return $this->success('Successfuly delete branch!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
}
