@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Todo Student',
    'subtitle' => 'list todo student',
    'breadcrumb' => [
        'wakatime',
        'todo student'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>List Student</h5>
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
                            <select name="showitem" class="form-control" data-url="/todo/student">
                                {!! HelperTag::showItem(request()->show ?? 5) !!}
                            </select>
                        </div>
                        <div class="col"></div>
                        <div class="col-md-4">
                            <div class="input-group input-group-button">
                                <input type="text" name="keyword" data-url="/todo/student" class="form-control" placeholder="Search ..." value="{{ request()->keyword }}">
                                <button type="button" class="input-group-addon btn btn-primary btn-paginate-search" data-url="/todo/student">
                                    <i class="feather icon-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-list">
                            <thead>
                                <tr class="bg-primary">
                                    <th width="40">No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th width="150">Username</th>
                                    <th width="190">Action</th>
                                </tr>
                            </thead>
                            <tbody id="listitem">
                                @php($no = $users->perPage() * $users->currentPage() - $users->perPage() + 1)
                                @foreach ($users as $item)    
                                <tr>
                                    <td align="center">{{ $no }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td class="action">
                                        <a href="{{ route('todo.view', ['user' => $item->id]) }}" class="btn btn-block btn-sm btn-primary">
                                            <i class="feather icon-eye"></i> View Todo
                                        </a>
                                    </td>
                                </tr>
                                @php($no = $no + 1)
                                @endforeach

                                @if ($users->total() < 1)
                                <tr>
                                    <td colspan="5" align="center">Data not found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right" id="pagination">
                        {{ $users->links('components.pagination.ajax') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection