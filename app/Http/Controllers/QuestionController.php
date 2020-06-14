<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Symfony\Component\Console\Question\Question as QuestionQuestion;

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
            $questions = Question::orderBy('id','desc')->limit(100)->get();

        return view('pages.question.index', compact('questions'));
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
            Question::create($data);
            return $this->success('Successfuly create new Question!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $Question)
    {
        return $this->success('Successfuly get data Question!', $Question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $Question)
    {
        $request->validate([
            'name' => 'required'
        ]);
        
        try {
            $Question->update($request->all());
            return $this->success('Successfuly update data Question!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $Question)
    {
        try {
            $Question->delete();
            return $this->success('Successfuly delete Question!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
}
