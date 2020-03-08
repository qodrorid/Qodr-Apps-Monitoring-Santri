@extends('templates.base')

@section('stylesheet')
{{ HTML::style('css/pages/list.css') }}
@endsection

@section('content')

@include('components.page-header', [
    'title' => 'Url Embed',
    'subtitle' => 'Management url embed wakatime',
    'breadcrumb' => [
        'wakatime',
        'url embed'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Setup Url</h5>
                    <span><b>Note :</b> url embed wakatime must be <code>json</code> and make sure the url goes well</span>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="col-md-12">
                        <ul class="basic-list list-icons">
                            <li>
                                <i class="icofont icofont-chart-bar-graph text-primary p-absolute text-center d-block f-30"></i>
                                <h6><b>Coding Activity</b></h6>
                                <code id="coding_activity">{{ $wakatime->coding_activity ?? 'null' }}</code>
                            </li>
                            <li>
                                <i class="icofont icofont-chart-pie-alt text-primary p-absolute text-center d-block f-30"></i>
                                <h6><b>Languages</b></h6>
                                <code id="languages">{{ $wakatime->languages ?? 'null' }}</code>
                            </li>
                            <li>
                                <i class="icofont icofont-chart-pie text-primary p-absolute text-center d-block f-30"></i>
                                <h6><b>Editors</b></h6>
                                <code id="editors">{{ $wakatime->editors ?? 'null' }}</code>
                            </li>
                        </ul>
                        <div class="float-left">
                            @if ($wakatime->status)
                            <button class="btn btn-success btn-sm btn-status">
                                Status Active
                            </button>
                            @else
                            <button class="btn btn-danger btn-sm btn-status">
                                Status Not Active
                            </button>
                            @endif
                        </div>
                        <div class="float-right">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form-wakatime">
                                Update Urls
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.wakatime.form')
@endsection

@section('javascript')
{{ HTML::script('js/pages/wakatime.js') }}
@endsection