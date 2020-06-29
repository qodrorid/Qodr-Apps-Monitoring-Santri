@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Survey Santri',
    'subtitle' => 'Manajemen Survey Santri',
    'breadcrumb' => ['Survey Santri']
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>Survey {{ $survey->title }}</h5>
                    <p>Tanggal Pengerjaan: {{ $survey->date_start . ' s/d '. $survey->date_end }}</p>
                    <p>Batas Waktu: {{ $survey->time_limit }} detik</p>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    @foreach ($questions as $question)
                        <div class="question-area mb-3">
                            <h5>{{ $loop->iteration }}. {{ $question->title }}</h5>
                            <ul class="ml-4 mt-2">
                                @foreach ($question->optionsRandom() as $option)
                                    <li>
                                        <input type="radio" name="answer[]" id="answer_{{ $option->id }}">
                                        <label for="answer_{{ $option->id }}">
                                            {{ $option_letter[$loop->iteration] .'. '. $option->answer }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
