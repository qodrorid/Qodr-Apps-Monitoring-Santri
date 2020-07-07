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
            <form action="" method="POST" id="form-survey">
                @csrf
                <input type="hidden" name="time_count" value="0" id="time_count_id">
                <div class="card">
                    <div class="card-header card-list">
                        <h5>Survey {{ $survey->title }}</h5>
                        <p>Tanggal Pengerjaan: {{ $survey->date_start . ' s/d '. $survey->date_end }}</p>
                        <p>Batas Waktu: </p>
                        <h3 class="text-danger"><b id="timer-text">0</b> detik</h3>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="feather icon-minus minimize-card"></i></li>
                                <li><i class="feather icon-maximize full-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($questions as $question)
                            <div class="question-area mb-3" id="question_{{ $question->id }}">
                                <h5>{{ $loop->iteration }}. {{ $question->title }}</h5>
                                <ul class="ml-4 mt-2">
                                    @foreach ($question->optionsRandom() as $option)
                                        <li>
                                        <input type="radio" name="answer[{{ $question->id }}]" id="answer_{{ $option->id }}" value="{{ $option->id }}">
                                            <label for="answer_{{ $option->id }}">
                                                {{ $option_letter[$loop->iteration] .'. '. $option->answer }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-lg btn-block" type="submit" id="btn-submit">
                            <i class="feather icon-send"></i> Submit Survey
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
    $(function() {
        let sec = parseInt('{{ $survey->time_limit }}');
        let timer = setInterval(function() {
            const timerCount = sec--;
            $('#timer-text').text(timerCount);
            $('#time_count_id').val(timerCount);
            if (sec == 100) {
                alert('waktu tersisa 100 detik lagi');
            }
            if (sec == 0) {
                // $('#form-survey').submit();
                $('#btn-submit').click();
            }
        }, 1000); // 1000 ms = 1 second
    });
    </script>
@endpush
