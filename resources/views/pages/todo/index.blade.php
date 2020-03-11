@extends('templates.base')

@section('stylesheet')
{{ HTML::style('plugins/icons/font-awesome/css/font-awesome.min.css') }}
@endsection

@section('content')

@include('components.page-header', [
    'title' => 'Todo',
    'subtitle' => 'Managent Todo',
    'breadcrumb' => [
        'Todo'
    ]
])

<div class="page-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-list">
                    <h5>List Todo</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-minus minimize-card"></i></li>
                            <li><i class="feather icon-maximize full-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block panels-wells">
                    <div class="row" id="listitem">
                        @forelse ($todos as $item)
                        @if ($loop->first && $item->date !== date('Y-m-d'))
                        <div class="col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading bg-primary" style="display:flex">
                                    <div style="flex:1">{{ date('d F Y') }}</div>
                                    <div onclick="todo('{{ date('Y-m-d') }}')">
                                        <i class="fa fa-edit"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading bg-primary" style="display:flex">
                                    <div style="flex:1">{{ date('d F Y', strtotime($item->date)) }}</div>
                                    @if ($loop->first && $item->date === date('Y-m-d'))
                                    <div onclick="todo('{{ date('Y-m-d') }}', '{{ $item->todo }}')">
                                        <i class="fa fa-edit"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="panel-body panel-todo">
                                    <ul class="todo-list" @if ($item->date === date('Y-m-d'))list-todos="{{ $item->todo }}"@endif>
                                        @foreach (json_decode($item->todo) as $key => $todo)
                                        <li @if ($item->date === date('Y-m-d'))onclick="checkTodo({{ $item->id }}, {{ $key }}, this)@endif">
                                            <div class="box-check">
                                                <i class="fa fa-check-square {{ ($todo->status == 1) ? 'text-primary' : '' }}"></i>
                                            </div>
                                            <div class="box-text">
                                                {{ $todo->todo }}
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-sm-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading bg-primary" style="display:flex">
                                    <div style="flex:1">{{ date('d F Y') }}</div>
                                    <div onclick="todo('{{ date('Y-m-d') }}')">
                                        <i class="fa fa-edit"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.todo.form')
@endsection

@section('javascript')
{{ HTML::script('js/pages/todo.js') }}
@endsection