@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Report Student',
    'subtitle' => 'report wakatime student',
    'breadcrumb' => [
        'wakatime',
        'report student'
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
                            <select name="showitem" class="form-control" data-url="/wakatime/url/list">
                                {!! HelperTag::showItem(request()->show ?? 5) !!}
                            </select>
                        </div>
                        <div class="col"></div>
                        <div class="col-md-4">
                            <div class="input-group input-group-button">
                                <input type="text" name="keyword" data-url="/wakatime/url/list" class="form-control" placeholder="Search ..." value="{{ request()->keyword }}">
                                <button type="button" class="input-group-addon btn btn-primary btn-paginate-search" data-url="/wakatime/url/list">
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
                                    <th>URL Embed</th>
                                    <th width="190">Action</th>
                                </tr>
                            </thead>
                            <tbody id="listitem">
                                @php($no = $users->perPage() * $users->currentPage() - $users->perPage() + 1)
                                @foreach ($users as $item)    
                                <tr>
                                    <td align="center">{{ $no }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <b>Coding Activity :</b>
                                        <code>{{ $item->coding_activity ?? 'null' }}</code>
                                        <a target="_blank" href="{{ $item->coding_activity ?? 'javascript:void(0)' }}"><i class="feather icon-link"></i></a>
                                        <br>

                                        <b>Languages :</b>
                                        <code>{{ $item->languages ?? 'null' }}</code>
                                        <a target="_blank" href="{{ $item->languages ?? 'javascript:void(0)' }}"><i class="feather icon-link"></i></a>
                                        <br>

                                        <b>Editors :</b>
                                        <code>{{ $item->editors ?? 'null' }}</code>
                                        <a target="_blank" href="{{ $item->editors ?? 'javascript:void(0)' }}"><i class="feather icon-link"></i></a>
                                    </td>
                                    <td class="action">
                                        @if ($item->status == 1)
                                        <button class="btn btn-block btn-sm btn-primary" onclick="activate({{ $item->id }}, 'Activate')">
                                            <i class="feather icon-check-circle"></i> Activate
                                        </button>
                                        @else
                                        <button class="btn btn-block btn-sm btn-danger" onclick="activate({{ $item->id }}, 'Deactivate')">
                                            <i class="feather icon-x-circle"></i> Deactivate
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @php($no = $no + 1)
                                @endforeach

                                @if ($users->total() < 1)
                                <tr>
                                    <td colspan="6" align="center">Data not found</td>
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

@section('javascript')
{{ HTML::script('js/pages/wakatime.js') }}
@endsection