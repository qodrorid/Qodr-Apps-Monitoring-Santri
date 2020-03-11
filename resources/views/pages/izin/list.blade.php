@php($no = $izin->perPage() * $izin->currentPage() - $izin->perPage() + 1)
@foreach ($izin as $item)    
<tr>
    <td align="center">{{ $no }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ date('H:i d F Y', strtotime($item->start)) }}</td>
    <td>{{ date('H:i d F Y', strtotime($item->end)) }}</td>
    <td>
        @if ($item->approved == 1)
        <span class="label label-primary">Approved</span>
        @elseif ($item->approved == 0)
        <span class="label label-danger">Rejected</span>
        @else
        <span class="label label-info">Process</span>
        @endif
    </td>
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
@php($no = $no + 1)
@endforeach

@if ($izin->total() < 1)
<tr>
    <td colspan="6" align="center">Data not found</td>
</tr>
@endif

<script>
(function() {
    @if ($izin->lastPage() > 1)
        $('#pagination').html(`{{ $izin->links('components.pagination.ajax') }}`)
    @else
        $('#pagination').html('')
    @endif
})()
</script>