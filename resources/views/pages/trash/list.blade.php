<table class="table table-bordered table-hover table-list">
    <thead>
        <tr class="bg-primary">
            @foreach ($fields as $filed)
            <th>{{ $filed }}</th>
            @endforeach
            <th width="180">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $item)
        <tr>
            @foreach ($fields as $filed)
            <td>{{ $item->$filed }}</td>
            @endforeach
            <td class="action">
                <div class="dropdown-primary dropdown open btn-block">
                    <button class="btn btn-primary btn-sm btn-block dropdown-toggle" type="button" id="action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="feather icon-cpu"></i> Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="action" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                        <a class="dropdown-item" onclick="restored({{ $item->id }}, '{{ $table }}')">
                            <i class="feather icon-corner-up-right"></i> Restore
                        </a>
                        <a class="dropdown-item" onclick="deleted({{ $item->id }}, '{{ $table }}')">
                            <i class="feather icon-trash"></i> Delete
                        </a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach

        @if ($datas->total() < 1)
        <tr>
            <td colspan="{{ count($fields) + 1 }}" align="center">Data not found</td>
        </tr>
        @endif
    </tbody>
</table>

<script>
    (function() {
    @if ($datas->lastPage() > 1)
        $('#pagination').html(`{{ $datas->links('components.pagination.ajax') }}`)
    @else
        $('#pagination').html('')
    @endif
    })()
</script>