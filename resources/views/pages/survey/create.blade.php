@extends('templates.base')

@section('content')

@include('components.page-header', [
'title' => ' Tambah Survey Soal',
'subtitle' => 'Manajement Tambah Survey Soal',
'breadcrumb' => [
'Master',
'Survey Soal',
'Add'
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
                    <form method="POST" action="{{url('/survey')}}" novalidate="">
                        @csrf

                        {{-- form  start --}}
                        @include('pages.survey.form')
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
    <style>
        .datepicker-days {
            padding: .5rem;
        }
        .datepicker table tr td.today, .datepicker table tr td.today.disabled, .datepicker table tr td.today.disabled:hover, .datepicker table tr td.today:hover {
            background-color: #fde19a;
            background-image: -moz-linear-gradient(to bottom,#fdd49a,#fdf59a);
            background-image: -ms-linear-gradient(to bottom,#fdd49a,#fdf59a);
            background-image: -webkit-gradient(linear,0 0,0 100%,from(#fdd49a),to(#fdf59a));
            background-image: -webkit-linear-gradient(to bottom,#fdd49a,#fdf59a);
            background-image: -o-linear-gradient(to bottom,#fdd49a,#fdf59a);
            background-image: linear-gradient(to bottom,#9ad2fd,#9aa0fd);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#fdd49a', endColorstr='#fdf59a', GradientType=0);
            border-color: #b0fd9a #fdf59a #fbed50;
            border-color: rgba(0,0,0,.1) rgba(0,0,0,.1) rgba(0,0,0,.25);
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            color: #000;
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
