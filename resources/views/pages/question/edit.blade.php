@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Soal',
    'subtitle' => 'Create Soal',
    'breadcrumb' => [
        'Master',
        'Edit Soal'
    ]
])
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>Edit Soal</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-list">
                            <form action="{{ route('soal.update', $questions['id']) }}" method="post">
                                @method('put')
                                @csrf
                                <div class="form-group">
                                    <label for="title">Judul Soal</label>
                                    <input type="text" name="title" id="title" class="form-control" required value="{{ $questions->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori</label>
                                    <select name="category_id" class="form-control" id="category_id" required>
                                        @foreach($categories as $categories)
                                            <option value="{{ $categories['id'] }}" 
                                            {{$categories->id == $questions->category_id ?  'selected' : ''}}> {{$categories->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="author_id">Pembuat</label>
                                    <input type="text" name="author_id" class="form-control" id="author_id" value="{{Auth()->User()->id}}" readonly>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="feather icon-plus"></i> Edit
                                </button>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('stylesheet')

@endsection

@section('javascript')

@endsection