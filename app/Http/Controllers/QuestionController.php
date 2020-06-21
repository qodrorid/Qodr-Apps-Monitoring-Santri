<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\User;
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
        $questions = Question::orderBy('id','desc')->limit(100)->get();

        return view('pages.question.index', compact('questions'));
    }

    public function create()
    {
        $questions = Question::all();
        $categories = QuestionCategory::all();
        $author = User::all();

        return view('pages.question.create', compact('questions','categories','author'));
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
            'category_id' => 'required',
            'note'        => 'nullable',
            'is_active'   => 'nullable',
            'author_id'   => 'required',
        ]);

        Question::create($request->all());

        return redirect()->route('soal.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $questions = Question::find($id);
        $categories = QuestionCategory::all();
        return view('pages.question.edit', compact('questions','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        Question::where('id', $question->id)
        ->update ([
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'note'        => $request->note,
            'is_active'   => $request->is_active,
            'author_id'   => $request->author_id
        ]);
        return redirect('/soal');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $Question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        try {
            $question->delete();
            return $this->success('Successfuly delete Question!');
        } catch (QueryException $error) {
            return $this->responseQueryException($error);
        }
    }
}
