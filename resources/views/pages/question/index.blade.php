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
                            <a href="{{ route('soal.create')}}" class="btn btn-primary btn-block"><i class="feather icon-plus"></i> Add</a>
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
                                    <td>{{ $item->kategori->name }}</td>
                                    <td>{{ $item->author->username }}</td>
                                    <td class="action">
                                        <a type="submit" class="btn btn-sm btn-info text-white" href="{{ route('soal.edit', $item['id']) }}"><i class="feather icon-edit"></i> Edit</a>
                                        <form method="post" action="{{ route('soal.destroy', $item['id']) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-sm btn-danger"><i class="feather icon-trash"></i> Hapus</button>
                                        </form>
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

@section('stylesheet')

@endsection

@section('javascript')
    <script src="{{ asset('plugins/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
@endsection