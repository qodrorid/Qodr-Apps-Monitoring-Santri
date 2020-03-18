<?php

namespace App\Http\Controllers;

use App\Models\CashFlow;
use App\Models\CashFlowDetail;
use Illuminate\Http\Request;

use Auth;

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
        $cashflowId = $request->rab_id;
        $parent     = CashFlow::where(function ($query) use ($cashflowId) {
            if (!is_null($cashflowId)) {
                $query->where('id', $cashflowId);
            } else {
                $query->where('month', date('F'));
            }
        })->where('branch_id', $branchId)->orderBy('date', 'desc')->first();
        
        $cashflow = $parent ? CashFlowDetail::where('cash_flow_id', $parent->id)->orderBy('date', 'asc')->get() : [];
        $view     = $request->ajax() ? 'list' : 'index';
        $disable  = ($parent && $parent->month !== date('F') and $parent->month !== now()->addMonth('1')->format('F')) ? true : false;

        return view('pages.cashflow.' . $view, compact('cashflow', 'disable', 'parent'));
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
            'cash_flow_id' => 'required',
            'date'         => 'required',
            'for'          => 'required',
            'qty'          => 'required',
            'type'         => 'required',
            'price'        => 'required',
            'debit'        => 'required',
            'kredit'       => 'required'
        ]);
        
        $data = $request->all();

        try {
            CashFlowDetail::create($data);
            return $this->success('Successfuly create new row!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CashFlowDetail $cashflow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CashFlowDetail $cashflow)
    {
        $request->validate([
            'cash_flow_id' => 'required',
            'date'         => 'required',
            'for'          => 'required',
            'qty'          => 'required',
            'type'         => 'required',
            'price'        => 'required',
            'debit'        => 'required',
            'kredit'       => 'required'
        ]);

        $data = $request->all();
        
        try {
            $cashflow->update($data);
            return $this->success('Successfuly update data cash flow!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashFlowDetail $cashflow
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashFlowDetail $cashflow)
    {
        try {
            $cashflow->delete();
            return $this->success('Successfuly delete cash flow!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
}
