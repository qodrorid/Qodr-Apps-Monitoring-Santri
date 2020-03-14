@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Class IT',
    'subtitle' => 'Managent Class IT',
    'breadcrumb' => [
        'Class IT'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>List Class IT</h5>
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
                            <div class="form-group">
                                <select name="showitem" class="form-control" data-url="/classit">
                                    {!! HelperTag::showItem(request()->show ?? 5) !!}
                                </select>
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="col-md-4">
                            <div class="input-group input-group-button">
                                <input type="text" name="keyword" data-url="/classit" class="form-control" placeholder="Search ..." value="{{ request()->keyword }}">
                                <button type="button" class="input-group-addon btn btn-primary btn-paginate-search" data-url="/classit">
                                    <i class="feather icon-search"></i> Search
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#form-classit">
                                    <i class="feather icon-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-list">
                            <thead>
                                <tr class="bg-primary">
                                    <th width="40">No</th>
                                    <th width="150">Start Time</th>
                                    <th>Title</th>
                                    <th width="150">Mentor</th>
                                    <th width="150">Participant</th>
                                    <th width="190">Action</th>
                                </tr>
                            </thead>
                            <tbody id="listitem">
                                @php($no = $classit->perPage() * $classit->currentPage() - $classit->perPage() + 1)
                                @foreach ($classit as $item)    
                                <tr>
                                    <td align="center">{{ $no }}</td>
                                    <td>{{ date('H:i | d F Y', strtotime($item->start_time)) }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->mentor }}</td>
                                    <td><span class="label label-primary">{{ count(json_decode($item->participant)) }} Participant</span></td>
                                    <td class="action">
                                        <div class="dropdown-primary dropdown open btn-block">
                                            <button class="btn btn-primary btn-sm btn-block dropdown-toggle" type="button" id="action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="feather icon-cpu"></i> Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="action" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <a class="dropdown-item" onclick="edit({{ $item->id }})">
                                                    <i class="feather icon-edit"></i> Edit
                                                </a>
                                                <a class="dropdown-item" onclick="deleted({{ $item->id }})">
                                                    <i class="feather icon-trash"></i> Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php($no = $no + 1)
                                @endforeach

                                @if ($classit->total() < 1)
                                <tr>
                                    <td colspan="6" align="center">Data not found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right" id="pagination">
                        {{ $classit->links('components.pagination.ajax') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.classit.form')
@endsection

@section('javascript')
{{ HTML::script('js/pages/classit.js') }}
@endsection