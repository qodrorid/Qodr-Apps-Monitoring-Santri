@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Soal',
    'subtitle' => 'Manajemen Soal',
    'breadcrumb' => [
        'Master'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>Daftar Soal</h5>
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
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#form-soal">
                                <i class="feather icon-plus"></i> Add
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-list">
                            <thead>
                                <tr class="bg-primary">
                                    <th width="40">No</th>
                                    <th width="150">Judul Soal</th>
                                    <th>Kategori</th>
                                    <th width="190">Pembuat</th>
                                    <th width="190">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="listitem">
                                @foreach ($questions as $item)    
                                <tr>
                                    <td align="center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->category_id }}</td>
                                    <td>{{ $item->author_id }}</td>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection