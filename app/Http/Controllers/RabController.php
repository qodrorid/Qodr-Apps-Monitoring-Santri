<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RabDetail;
use App\Models\Rab;

use Auth;

class RabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branchId = Auth::user()->branch_id;
        $rabId    = $request->rab_id;
        $parent   = Rab::where(function ($query) use ($rabId) {
            if (!is_null($rabId)) {
                $query->whare('id', $rabId);
            }
        })->where('branch_id', $branchId)->orderBy('date', 'desc')->first();
        $rab      = $parent ? RabDetail::where('rab_id', $parent->id)->get() : [];

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.rab.' . $view, compact('rab', 'parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
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
            'rab_id' => 'required',
            'for'    => 'required',
            'qty'    => 'required',
            'price'  => 'required',
            'total'  => 'required'
        ]);

        $data = $request->all();

        try {
            RabDetail::create($data);
            return $this->success('Successfuly create new row!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RabDetail $rab
     * @return \Illuminate\Http\Response
     */
    public function edit(RabDetail $rab)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RabDetail $rab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RabDetail $rab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RabDetail $rab
     * @return \Illuminate\Http\Response
     */
    public function destroy(RabDetail $rab)
    {
        //
    }
}
