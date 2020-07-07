<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyRequest;
use App\Models\Survey;
use App\Models\SurveyUser;
use App\Models\SurveyUserDetail;
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

    public function santriMulai($id)
    {
        $survey = Survey::with('questions')->findOrFail($id);
        $questions = $survey->questions()->inRandomOrder()->get();
        $option_letter = ['', 'A', 'B', 'C', 'D', 'E'];

        return view('pages.survey.santri_mulai', compact('survey', 'questions', 'option_letter'));
    }

    public function santriSimpan(Request $request, $survey_id)
    {
        $survey = Survey::findOrFail($survey_id);
        $time_count = (int) $survey->time_limit - (int) $request->time_count;
        $survey_user = SurveyUser::create([
            'survey_id' => $survey_id,
            'santri_id' => auth()->user()->id,
            'time_count' => $time_count
        ]);

        if (!$survey_user) {
            return back()->with('error', 'Gagal membuat data survey user');
        }

        // detail data
        // $question_id = array_keys($request->answer);
        foreach ($request->answer as $question_id => $answer_id) {
            $survey_user_detail = SurveyUserDetail::create([
                'survey_user_id' => $survey_user->id,
                'question_id' => $question_id,
                'user_answer_id' => $answer_id
            ]);

            if (!$survey_user_detail) {
                return back()->with('error', 'Gagal membuat detail survey user');
            }

            // TODO
            // buat pengecekan jawaban bener atau tidak
            // bandingkan di tabel question answer field $option_id dgn $answer_id diatas
            // hitung score => 1 benar = 1 score
        }

        // TODO
        // rubah jdi insert sekali banyak => SurveyUserDetail::insert($data_user_detail)
        // update score di table survey_user => $survey_user->update(['score' => $score])

        return redirect('santri/survey')->with('info', 'Berhasil menyimpan data survey');
    }
}
