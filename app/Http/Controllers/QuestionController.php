<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionRequest;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $Question = Question::where(function($query) use ($request) {
        //     if (!is_null($request->keyword)) {
        //         $query->where('name', 'like', "%$request->keyword%");
        //     }
        // })->paginate($request->showitem ?? 5);

        // $Question->appends($request->query());

        // $view = $request->ajax() ? 'list' : 'index';

        $questions = Question::orderBy('id', 'desc')->limit(100)->get();


        return view('pages.question.index', compact('questions'));
    }


    public function create()
    {
        $categories = QuestionCategory::pluck('name', 'id');
        $authors    = User::pluck('username', 'id');


        return view('pages.question.create', compact('categories','authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {

        $question = Question::create($request->all());

        return redirect('/soal')->with('success', 'berhasil menambah data baru');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Question::find($id);
        $categories = QuestionCategory::pluck('name', 'id');
        $authors    = User::pluck('username', 'id');

        return view('pages.question.edit',compact('data','categories','authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request,  $id)
    {
        $data = Question::where('id',$id)->first();
        $data->update($request->all());


        return redirect('/soal')->with('info', 'berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::destroy($id);

        return redirect('/soal');
    }
}
