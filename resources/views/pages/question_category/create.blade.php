@extends('templates.base')

@section('content')

@include('components.page-header', [
'title' => ' Tambah Kategori Soal',
'subtitle' => 'Manajement Tambah Kategori Soal',
'breadcrumb' => [
'Master',
'Kategori Soal',
'Add'
]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <!-- Basic Inputs Validation start -->
            <div class="card">
                <div class="card-header">
                    <h5>Tambah Data Kategori Soal</h5>
                </div>
                <div class="card-block">
                    <form method="POST" action="{{url('/kategori-soal')}}" novalidate="">
                        @csrf

                        {{-- form  start --}}
                        @include('pages.question_category.form')
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
