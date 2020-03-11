@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Telegram',
    'subtitle' => 'Get telegram bot chat id',
    'breadcrumb' => [
        'Telegram'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>List Telegram Bot Chat ID</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-list">
                            <thead>
                                <tr class="bg-primary">
                                    <th width="40">No</th>
                                    <th width="200">ID Chat</th>
                                    <th>Name Group</th>
                                </tr>
                            </thead>
                            <tbody id="listitem">
                                @foreach ($telegram as $item) 
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->message->chat->id }}</td>
                                    <td>{{ $item->message->chat->title }}</td>
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