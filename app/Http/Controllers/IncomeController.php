<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\CashFlow;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $income = Income::where(function($query) use ($request) {
            if (!is_null($request->keyword)) {
                $query->where('name', 'like', "%$request->keyword%")
                    ->orWhere('information', 'like', "%$request->keyword%");
            }
        })->paginate($request->showitem ?? 5);

        $income->appends($request->query());

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.income.' . $view, compact('income'));
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
            'user_id' => 'required',
            'name'    => 'required',
            'date'    => 'required',
            'nominal' => 'required'
        ]);

        if ($this->checkCashFLow($request->date)) return abort(400, 'Cash flow not found!');

        $data = $request->all();

        try {
            Income::create($data);
            return $this->success('Successfuly create new income!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        return $this->success('Successfuly get data income!', $income);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'user_id' => 'required',
            'name'    => 'required',
            'date'    => 'required',
            'nominal' => 'required'
        ]);
        
        try {
            $income->update($request->all());
            return $this->success('Successfuly update data income!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        try {
            $income->delete();
            return $this->success('Successfuly delete income!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * check cash flow
     * 
     * @param  int $id
     * @return bool
     */
    private function checkCashFLow($date)
    {
        $cashFlow = CashFlow::whereMonth('date', date('m', strtotime($date)))->first();
        return is_null($cashFlow) ? true : false;
    }
}
