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
                                <td>{{$item->time_limit}} detik</td>
                                <td>
                                    <a href="{{ url('santri/survey/'. $item->id) }}" class="btn-sm btn-primary">
                                        <i class="feather icon-edit"></i> Mulai
                                    </a>
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
