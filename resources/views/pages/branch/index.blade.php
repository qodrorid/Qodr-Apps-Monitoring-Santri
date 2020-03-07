@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Branch',
    'subtitle' => 'Managent Branch',
    'breadcrumb' => [
        'Settings'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>List Branch</h5>
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
                            <select name="showitem" class="form-control" data-url="/branch">
                                {!! HelperTag::showItem(request()->show ?? 5) !!}
                            </select>
                        </div>
                        <div class="col"></div>
                        <div class="col-md-4">
                            <div class="input-group input-group-button">
                                <input type="text" name="keyword" data-url="/branch" class="form-control" placeholder="Search ..." value="{{ request()->keyword }}">
                                <button type="button" class="input-group-addon btn btn-primary btn-paginate-search" data-url="/branch">
                                    <i class="feather icon-search"></i> Search
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#form-branch">
                                <i class="feather icon-plus"></i> Add
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-list">
                            <thead>
                                <tr class="bg-primary">
                                    <th width="40">No</th>
                                    <th width="150">Name</th>
                                    <th>Address</th>
                                    <th width="190">Action</th>
                                </tr>
                            </thead>
                            <tbody id="listitem">
                                @php($no = $branch->perPage() * $branch->currentPage() - $branch->perPage() + 1)
                                @foreach ($branch as $item)    
                                <tr>
                                    <td align="center">{{ $no }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->address }}</td>
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

                                @if ($branch->total() < 1)
                                <tr>
                                    <td colspan="4" align="center">Data not found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right" id="pagination">
                        {{ $branch->links('components.pagination.ajax') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.branch.form')
@endsection

@section('javascript')
{{ HTML::script('js/pages/branch.js') }}
@endsection