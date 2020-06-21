@extends('templates.base')

@section('content')

@include('components.page-header', [
'title' => ' Edit Survey Soal',
'subtitle' => 'Manajement Edit Survey Soal',
'breadcrumb' => [
'Master',
'Survey Soal',
'Edit'
]
])

@include('templates.alert')

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <!-- Basic Inputs Validation start -->
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Data Soal</h5>
                </div>
                <div class="card-block">
                    <form method="post" action="{{url('survey/'.$data->id)}}" novalidate="">
                        @method('put')
                        @csrf

                        {{-- form  start --}}
                        @include('pages.survey.form', ['surveys' => $data ])
                        {{-- form end --}}
                        <div class="form-group row">
                            <label class="col-sm-2"></label>
                            <div class="col-sm-10">
                                <button type="submit" name="submit" class="btn btn-primary m-b-0">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Basic Inputs Validation end -->
        </div>
    </div>
</div>
@endsection
@push('css')
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

    {{-- datepicker --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha256-siyOpF/pBWUPgIcQi17TLBkjvNgNQArcmwJB8YvkAgg=" crossorigin="anonymous" />

    {{-- custom --}}
    <style>
        .datepicker-days {
            padding: .5rem;
        }

        .datepicker table tr td.today, .datepicker table tr td.today.disabled, .datepicker table tr td.today.disabled:hover, .datepicker table tr td.today:hover {
            background-color: #02a9ac;
            background-image: -moz-linear-gradient(to bottom,#09d3d7,#02a9ac);
            background-image: -ms-linear-gradient(to bottom,#09d3d7,#02a9ac);
            background-image: -webkit-gradient(linear,0 0,0 100%,from(#02a9ac),to(#028c8f));
            background-image: -webkit-linear-gradient(to bottom,#09d3d7,#02a9ac);
            background-image: -o-linear-gradient(to bottom,#09d3d7,#02a9ac);
            background-image: linear-gradient(to bottom,#09d3d7,#02a9ac);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#09d3d7', endColorstr='#02a9ac', GradientType=0);
            border-color: #02a9ac #06c9cc #017a7c;
            border-color: rgba(0,0,0,.1) rgba(0,0,0,.1) rgba(0,0,0,.25);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            color: #fff;
        }

        .day {
            padding-left: 1px;
        }
    </style>
@endpush
@push('js')
     {{-- select2 --}}
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js" integrity="sha256-NNMNW7d0OGoiO4RqoKSdLCcr+0E6rgu1hqzpYkh5BIM=" crossorigin="anonymous"></script>

     <script>
        $(document).ready(function() {
          // init select2
            $('.select2').select2();

             // init datepicker
          $('.datepicker').datepicker({
            language: 'id',
            format: 'dd MM yyyy',
            todayHighlight: true
          });



        });
      </script>
@endpush
