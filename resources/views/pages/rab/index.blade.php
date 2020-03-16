@extends('templates.base')

@section('content')

@include('components.page-header', [
    'title' => 'RAB',
    'subtitle' => 'Managent RAB',
    'breadcrumb' => [
        'RAB'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>List Data</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-block">
                                    <i class="feather icon-plus-circle"></i> Create Rab
                                </button>
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <select name="rab_id" id="rab_id" class="form-control">
                                    {!! HelperTag::rab() !!}
                                </select>
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-block">
                                    <i class="feather icon-plus"></i> Add Row
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-list">
                            <thead>
                                <tr class="bg-primary">
                                    <th width="45">No</th>
                                    <th>For</th>
                                    <th width="80">Qty</th>
                                    <th width="140">Price</th>
                                    <th width="140">Total</th>
                                    <th width="190">Action</th>
                                </tr>
                            </thead>
                            <tbody id="listitem">
                                @foreach($rab as $item)
                                <tr>
                                    <td align="center">{{ $loop->iteration }}</td>
                                    <td>{{ $item->for }}</td>
                                    <td align="center">{{ $item->qty }}</td>
                                    <td align="right">{!! HelperView::currency($item->price) !!}</td>
                                    <td align="right">{!! HelperView::currency($item->total) !!}</td>
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
<div id="new-row" style="display:none">
    <table>
        <tbody>
            <tr class="add-row">
                <td class="p-1">
                    <button type="button" class="btn btn-danger btn-sm pr-2 btn-remove" onclick="removeRow(this)">
                        <i class="feather icon-trash-2"></i>
                    </button>
                </td>
                <td class="p-1">
                    <input type="text" name="for" id="for" class="form-control" placeholder="for" autofocus data-toggle="tooltip" data-placement="bottom" title="required" data-trigger="manual">
                </td>
                <td class="p-1">
                    <input type="number" name="qty" id="qty" min="1" class="form-control" value="1" onkeyup="countTotal()" onchange="countTotal()" placeholder="qty" data-toggle="tooltip" data-placement="bottom" title="required" data-trigger="manual">
                </td>
                <td class="p-1">
                    <input type="text" name="price" id="price" class="form-control" value="0" onkeyup="countTotal()" onchange="countTotal()" placeholder="price" data-toggle="tooltip" data-placement="bottom" title="required" data-trigger="manual">
                </td>
                <td class="p-1">
                    <input type="text" disabled id="total" class="form-control" value="0" onkeyup="countTotal()" onchange="countTotal()" placeholder="total" data-toggle="tooltip" data-placement="bottom" title="required" data-trigger="manual">
                </td>
                <td class="p-1">
                    <button type="button" class="btn btn-primary btn-sm btn-block btn-submit" onclick="submitRow()">
                        submit
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@section('javascript')
{{ HTML::script('plugins/form-masking/inputmask.js') }}
{{ HTML::script('plugins/form-masking/jquery.inputmask.js') }}
{{ HTML::script('plugins/form-masking/autoNumeric.js') }}
{{ HTML::script('plugins/form-masking/form-mask.js') }}
{{ HTML::script('js/pages/rab.js') }}
@endsection