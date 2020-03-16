<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RabDetail;
use App\Models\Rab;
use App\Utils\HelperTag;

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
                $query->where('id', $rabId);
            } else {
                $query->where('month', date('F'));
            }
        })->where('branch_id', $branchId)->orderBy('date', 'desc')->first();
        
        $rab     = $parent ? RabDetail::where('rab_id', $parent->id)->get() : [];
        $view    = $request->ajax() ? 'list' : 'index';
        $disable = ($parent && $parent->month !== date('F') and $parent->month !== now()->addMonth('1')->format('F')) ? true : false;

        return view('pages.rab.' . $view, compact('rab', 'disable', 'parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'date' => 'required'
        ]);

        $branchId = Auth::user()->branch_id;
        $date     = $request->date . '-01';

        $check = Rab::where('date', $date)->first();

        if ($check) {
            return $this->error(400, 'Rab is exist!');
        }
        
        $data = [
            'branch_id' => $branchId,
            'date'      => $date,
            'month'     => date('F', strtotime($date)),
            'year'      => date('Y', strtotime($date))
        ];

        try {
            Rab::create($data);

            $rabs = HelperTag::rab();
            return $this->success('Successfuly create new rab!', $rabs);
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RabDetail $rab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RabDetail $rab)
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
            $rab->update($data);
            return $this->success('Successfuly update data setting!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RabDetail $rab
     * @return \Illuminate\Http\Response
     */
    public function destroy(RabDetail $rab)
    {
        try {
            $rab->delete();
            return $this->success('Successfuly delete rab!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
}
