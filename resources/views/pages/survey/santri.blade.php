@extends('templates.base')

@section('content')

@include('components.page-header', [
'title' => 'Survey Santri',
'subtitle' => 'Manajement Survey Santri',
'breadcrumb' => [
'Survey Santri'
]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>Daftar Survey Santri</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-list">
                        <thead>
                            <tr class="bg-primary">
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tanggal Pelaksaan</th>
                                <th>Batas Waktu</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="listitem">
                            @foreach ($surveys as $item)
                            <tr>
                                <td align="center">{{$loop->iteration}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->date_start}} s/d {{$item->date_end}}</td>
                                <td>{{$item->time_limit}}</td>
                                <td class="action">
                                    <div class="dropdown-primary dropdown open btn-block">
                                        <button class="btn btn-primary btn-sm btn-block dropdown-toggle" type="button"
                                            id="action" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="true">
                                            <i class="feather icon-cpu"></i> Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="action" data-dropdown-in="fadeIn"
                                            data-dropdown-out="fadeOut">
                                            <a href="" class="dropdown-item btn-sm">
                                                <i class="feather icon-edit"></i> Mulai
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
