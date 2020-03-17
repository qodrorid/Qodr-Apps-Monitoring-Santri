<?php

namespace App\Http\Controllers;

use App\Models\CashFlow;
use App\Models\CashFlowDetail;
use Illuminate\Http\Request;

class CashFlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branchId   = Auth::user()->branch_id;
        $cashFlowId = $request->rab_id;
        $parent     = CashFlow::where(function ($query) use ($cashFlowId) {
            if (!is_null($cashFlowId)) {
                $query->where('id', $cashFlowId);
            } else {
                $query->where('month', date('F'));
            }
        })->where('branch_id', $branchId)->orderBy('date', 'desc')->first();
        
        $cashFlow = $parent ? CashFlowDetail::where('cash_flow_id', $parent->id)->get() : [];
        $view     = $request->ajax() ? 'list' : 'index';
        $disable  = ($parent && $parent->month !== date('F') and $parent->month !== now()->addMonth('1')->format('F')) ? true : false;

        return view('pages.cashflow.' . $view, compact('cashFlow', 'disable', 'parent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashFlow  $cashFlow
     * @return \Illuminate\Http\Response
     */
    public function show(CashFlow $cashFlow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashFlow  $cashFlow
     * @return \Illuminate\Http\Response
     */
    public function edit(CashFlow $cashFlow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CashFlow  $cashFlow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashFlow $cashFlow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashFlow  $cashFlow
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashFlow $cashFlow)
    {
        //
    }
}
