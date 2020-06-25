@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Survey Soal',
    'subtitle' => 'Manajement Survey Soal',
    'breadcrumb' => [
        'Master',
        'Survey Soal'
    ]
])

@include('templates.alert')
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>Daftar Kategori Soal</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">       
                        @if (auth()->user()->role_id == 2)
                        <div class="col-md-2">
                            <a href="{{ url('survey/create') }}" class="btn btn-primary btn-block"><i class="feather icon-plus"></i> Add</a>
                        </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-list">
                            <thead>
                                <tr class="bg-primary">
                                    <th>No</th>
                                    <th>Judul Survey</th>
                                    <th>Pembuat</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
                                    <th>Batas Waktu</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="listitem">
                                @foreach ($surveys as $item)
                                <tr>
                                    <td align="center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->author->username }}</td>
                                    <td>{{ $item->date_start }}</td>
                                    <td>{{ $item->date_end }}</td>
                                    <td>{{ $item->time_limit }}</td>
                                    <td>{{ $item->note }}</td>
                                    <td class="action">
                                        @if (auth()->user()->role_id == 9)
                                        <div class="dropdown-primary dropdown open btn-block">
                                            <button class="btn btn-primary btn-sm btn-block dropdown-toggle" type="button" id="action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="feather icon-cpu"></i> Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="action" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a href="#" class="dropdown-item">
                                                        <i class="feather icon-external-link"></i> Mulai
                                                    </a>
                                            </div>
                                        </div>
                                        @endif
                                        @if (auth()->user()->role_id == 2)
                                        <div class="dropdown-primary dropdown open btn-block">
                                            <button class="btn btn-primary btn-sm btn-block dropdown-toggle" type="button" id="action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="feather icon-cpu"></i> Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="action" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <form action="{{url('survey/'.$item->id)}}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <a href="{{url('survey/'.$item->id.'/edit') }}" class="dropdown-item">
                                                        <i class="feather icon-edit"></i> Edit
                                                    </a>
                                                    <button type="submit" class="dropdown-item btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ?');">
                                                        <i class="feather icon-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
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
@push('css')
<style>
    select.form-control:not([size]):not([multiple]) {
        height: calc(2.25rem + 2px);
        margin-left: 32px;
        padding: 1px;
    }

    div.dataTables_wrapper div.dataTables_info {
        display: inline-block;
        margin-left: 32px;
    }

</style>
@endpush
@section('css')
    <!-- Data Table Css -->
 <link rel="stylesheet" type="text/css" href="{{asset ('plugins\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css') }}">
 <link rel="stylesheet" type="text/css" href="{{asset ('plugins\assets\pages\data-table\css\buttons.dataTables.min.css') }}">
 <link rel="stylesheet" type="text/css" href="{{asset ('plugins\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css') }}">
 <link rel="stylesheet" type="text/css" href="{{asset ('plugins\assets\pages\data-table\extensions\autofill\css\autoFill.dataTables.min.css') }}">
 <link rel="stylesheet" type="text/css" href="{{asset ('plugins\assets\pages\data-table\extensions\autofill\css\select.dataTables.min.css') }}">
@endsection

@section('javascript')
 <!-- data-table js -->
 <script src="{{ asset ('plugins\bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset ('plugins\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset ('plugins\assets\pages\data-table\js\jszip.min.js') }}"></script>
 <script src="{{ asset ('plugins\assets\pages\data-table\js\pdfmake.min.js') }}"></script>
 <script src="{{ asset ('plugins\assets\pages\data-table\js\vfs_fonts.js') }}"></script>
 <script src="{{ asset ('plugins\assets\pages\data-table\extensions\autofill\js\dataTables.autoFill.min.js') }}"></script>
 <script src="{{ asset ('plugins\assets\pages\data-table\extensions\autofill\js\dataTables.select.min.js') }}"></script>
 <script src="{{ asset ('plugins\bower_components\datatables.net-buttons\js\buttons.print.min.js') }}"></script>
 <script src="{{ asset ('plugins\bower_components\datatables.net-buttons\js\buttons.html5.min.js') }}"></script>
 <script src="{{ asset ('plugins\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js') }}"></script>
 <script src="{{ asset ('plugins\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset ('plugins\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js') }}"></script>
 <script>
   $(document).ready( function () {
     $('.table').DataTable({
       language: {
         "sProcessing":   "Sedang proses...",
         "sLengthMenu":   " _MENU_",
         "sZeroRecords":  "Tidak ditemukan data yang sesuai",
         "sInfo":         "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
         "sInfoEmpty":    "Tampilan 0 hingga 0 dari 0 entri",
         "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
         "sInfoPostFix":  "",
         "sSearch":       "Cari:",
         "sUrl":          "",
         "oPaginate": {
             "sFirst":    "Awal",
             "sPrevious": "<i class='fa fa-arrow-left'><i> Kembali",
             "sNext":     "Lanjut",
             "sLast":     "Akhir"
       }
     }

     });
   });
 </script>
@endsection
