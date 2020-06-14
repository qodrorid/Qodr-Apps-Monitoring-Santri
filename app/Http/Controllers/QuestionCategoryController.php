<?php

namespace App\Http\Controllers;

use App\Models\QuestionCategory;
use Illuminate\Http\Request;

class QuestionCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = QuestionCategory::orderBy('id','desc')->limit(100)->get();

        return view('pages.question_category.index', compact('categories'));
    }
}
