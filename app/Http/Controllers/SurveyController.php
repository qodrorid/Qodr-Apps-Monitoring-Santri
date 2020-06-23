<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyRequest;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Cache\RetrievesMultipleKeys;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class SurveyController extends Controller
{
    public function index()
    {

        $surveys = Survey::orderBy('id', 'desc')->limit(100)->get();

        return view('pages.survey.index', compact('surveys'));
    }

    public function create()
    {
        $authors = User::pluck('username', 'id');
        return view('pages.survey.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurveyRequest $request)
    {

        $surveys = Survey::create($request->all());


        return redirect('/survey')->with('success', 'berhasil menambah data baru');
    }

    public function edit($id)
    {
        $data = Survey::find($id);
        $authors = User::pluck('username', 'id');

        return view('pages.survey.edit', compact('data','authors'));
    }

    public function update(SurveyRequest $request, $id)
    {
        $data = Survey::where('id', $id)->first();
        $data->update($request->all());

        return redirect('/survey')->with('info', 'berhasil mengubah data');
    }

    public function destroy($id)
    {
        Survey::destroy($id);

        return redirect('/survey');
    }

    public function santri()
    {
        $surveys = Survey::orderBy('id', 'desc')->limit(100)->get();
        return view('pages.survey.santri', compact('surveys'));
    }
}
