@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Trash',
    'subtitle' => 'Managent Trash',
    'breadcrumb' => [
        'Trash'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>List Data</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="showitem" class="form-control" data-url="/trash/view">
                                {!! HelperTag::showItem(request()->show ?? 5) !!}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="showtables" class="form-control" data-url="/trash/view">
                                <option value="">--- Select Table ---</option>
                                @foreach ($tables as $item)
                                <option value="{{ $item->table }}">{{ $item->table }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col"></div>
                        <div class="col-md-4">
                            <div class="input-group input-group-button">
                                <input type="text" name="keyword" data-url="/trash/view" class="form-control" placeholder="Search ..." value="{{ request()->keyword }}">
                                <button type="button" class="input-group-addon btn btn-primary btn-paginate-search" data-url="/trash/view">
                                    <i class="feather icon-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" id="listitem">
                        <div class="alert alert-info icons-alert">
                            <p><strong>Note!</strong> Select a <code>table</code> to display data</p>
                        </div>
                    </div>
                    <div class="float-right" id="pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
{{ HTML::script('js/pages/trash.js') }}
@endsection