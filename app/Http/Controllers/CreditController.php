<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $credit = Credit::where(function($query) use ($request) {
            if (!is_null($request->keyword)) {
                $query->where('name', 'like', "%$request->keyword%")
                    ->orWhere('information', 'like', "%$request->keyword%");
            }
        })->paginate($request->showitem ?? 5);

        $credit->appends($request->query());

        $view = $request->ajax() ? 'list' : 'index';

        return view('pages.credit.' . $view, compact('credit'));
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
            'user_id'       => 'required',
            'name'          => 'required',
            'information'   => 'required',
            'nominal'       => 'required',
            'borrowed_date' => 'required',
            'refund_date'   => 'required'
        ]);

        $data = $request->all();

        try {
            Credit::create($data);
            return $this->success('Successfuly create new credit!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Credit $credit
     * @return \Illuminate\Http\Response
     */
    public function edit(Credit $credit)
    {
        return $this->success('Successfuly get data credit!', $credit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Credit $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Credit $credit)
    {
        $request->validate([
            'user_id'       => 'required',
            'name'          => 'required',
            'information'   => 'required',
            'nominal'       => 'required',
            'borrowed_date' => 'required',
            'refund_date'   => 'required'
        ]);
        
        try {
            $credit->update($request->all());
            return $this->success('Successfuly update data credit!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Credit $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Credit $credit)
    {
        try {
            $credit->delete();
            return $this->success('Successfuly delete credit!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Refunded Credit
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refund(Credit $credit)
    {
        try {
            $credit->status = 1;
            $credit->update();
            return $this->success('Successfuly refunded credit!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
}
