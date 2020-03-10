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
            <ul class="todo-list">
                @foreach (json_decode($item->todo) as $todo)
                <li>
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