@forelse ($todos as $item)
@if ($loop->first && $item->date !== date('Y-m-d'))
<div class="col-sm-6">
    <div class="panel panel-primary">
        <div class="panel-heading bg-primary" style="display:flex">
            <div style="flex:1">{{ date('d F Y') }}</div>
            @if (empty($view))
            <div onclick="todo('{{ date('Y-m-d') }}')">
                <i class="fa fa-edit"></i>
            </div>
            @endif
        </div>
    </div>
</div>
@endif
<div class="col-sm-6">
    <div class="panel panel-primary">
        <div class="panel-heading bg-primary" style="display:flex">
            <div style="flex:1">{{ date('d F Y', strtotime($item->date)) }}</div>
            @if (empty($view) and $loop->first and $item->date === date('Y-m-d'))
            <div onclick="todo('{{ date('Y-m-d') }}', '{{ $item->todo }}')">
                <i class="fa fa-edit"></i>
            </div>
            @endif
        </div>
        <div class="panel-body panel-todo">
            <ul class="todo-list" @if (empty($view) and $item->date === date('Y-m-d'))list-todos="{{ $item->todo }}"@endif>
                @foreach (json_decode($item->todo) as $key => $todo)
                <li @if (empty($view) and $item->date === date('Y-m-d'))onclick="checkTodo({{ $item->id }}, {{ $key }}, this)@endif">
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
@if (empty($view))
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
@endforelse