<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionCategory;
use App\Http\Requests\QuestionCategoryRequest;
use App\Models\Question;

class QuestionCategoryController extends Controller
{
    public function index(Request $request)
    {
        // $Question = Question::where(function($query) use ($request) {
        //     if (!is_null($request->keyword)) {
        //         $query->where('name', 'like', "%$request->keyword%");
        //     }
        // })->paginate($request->showitem ?? 5);

        // $Question->appends($request->query());

        // $view = $request->ajax() ? 'list' : 'index';

        $categories = QuestionCategory::orderBy('id', 'desc')->limit(100)->get();

        return view('pages.question_category.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.question_category.create');
    }

    public function store(QuestionCategoryRequest $request)
    {
        $categories = QuestionCategory::create($request->all());

        return redirect('/kategori-soal')->with('success', 'Berhasil Menambah Data Baru');
    }

    public function edit($id)
    {
        $data = QuestionCategory::find($id);

        return view('pages.question_category.edit', compact('data'));
    }

    public function update(QuestionCategoryRequest $request, $id)
    {
        $data = QuestionCategory::find($id);
        $data->update($request->all());

        return redirect('/kategori-soal')->with('info', 'Berhasil Mengubah Data');
    }

    public function destroy($id)
    {
        QuestionCategory::destroy($id);

        return redirect('/kategori-soal');
    }
}
