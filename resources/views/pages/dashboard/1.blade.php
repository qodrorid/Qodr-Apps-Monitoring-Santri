@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'Dashboard',
    'subtitle' => 'Control Panel',
    'breadcrumb' => [
        'dashboard'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="feather icon-alert-triangle bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Error Logs</span>
                    <h4>{{ $widget->logs }} Logs</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-pink f-16 feather icon-link m-r-10"></i>more then ...
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="feather icon-user-check bg-c-green card1-icon"></i>
                    <span class="text-c-green f-w-600">Role</span>
                    <h4>{{ $widget->role }} Access</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-green f-16 feather icon-link m-r-10"></i>more then ...
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="feather icon-user-plus bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">Users</span>
                    <h4>{{ $widget->user }} Users</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-yellow f-16 feather icon-link m-r-10"></i>more then ...
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="feather icon-home bg-c-blue card1-icon"></i>
                    <span class="text-c-blue f-w-600">Branch</span>
                    <h4>2 Branch</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-blue f-16 feather icon-link m-r-10"></i>more then ...
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection