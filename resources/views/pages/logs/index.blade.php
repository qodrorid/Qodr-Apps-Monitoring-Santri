@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Logs',
    'subtitle' => 'Managent Log',
    'breadcrumb' => [
        'Logs'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>View Logs</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="filename" id="filename" class="form-control">
                                @foreach ($logs as $log)
                                <option value="{{ $log }}">{{ $log }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <pre id="view-log">{{ $view }}</pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $('#filename').change(function() {
        let filename = $(this).val()
        Swal.fire({
            customClass: {
                actions: 'swal2-icon-size',
                popup: 'swal2-bg'
            },
            allowOutsideClick: false,
            onBeforeOpen: () => {
                $.get(urlbase(`/logs/${filename}`), response => {
                    $('pre#view-log').html(response)
                    Swal.close()
                })
            }
        })
    })
</script>
@endsection