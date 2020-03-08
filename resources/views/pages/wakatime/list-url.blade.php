@php($no = $users->perPage() * $users->currentPage() - $users->perPage() + 1)
@foreach ($users as $item)    
<tr>
    <td align="center">{{ $no }}</td>
    <td>{{ $item->name }}</td>
    <td>
        <b>Coding Activity :</b>
        <code>{{ $item->coding_activity ?? 'null' }}</code>
        <a target="_blank" href="{{ $item->coding_activity ?? 'javascript:void(0)' }}"><i class="feather icon-link"></i></a>
        <br>

        <b>Languages :</b>
        <code>{{ $item->languages ?? 'null' }}</code>
        <a target="_blank" href="{{ $item->languages ?? 'javascript:void(0)' }}"><i class="feather icon-link"></i></a>
        <br>

        <b>Editors :</b>
        <code>{{ $item->editors ?? 'null' }}</code>
        <a target="_blank" href="{{ $item->editors ?? 'javascript:void(0)' }}"><i class="feather icon-link"></i></a>
    </td>
    <td class="action">
        @if ($item->status)
        <button class="btn btn-block btn-sm btn-primary" onclick="activate({{ $item->id }}, 'Activate')">
            <i class="feather icon-check-circle"></i> Activate
        </button>
        @else
        <button class="btn btn-block btn-sm btn-danger" onclick="activate({{ $item->id }}, 'Deactivate')">
            <i class="feather icon-x-circle"></i> Deactivate
        </button>
        @endif
    </td>
</tr>
@php($no = $no + 1)
@endforeach

@if ($users->total() < 1)
<tr>
    <td colspan="6" align="center">Data not found</td>
</tr>
@endif

<script>
(function() {
    @if ($users->lastPage() > 1)
    $('#pagination').html(`{{ $users->links('components.pagination.ajax') }}`)
    @else
    $('#pagination').html('')
    @endif
})()
</script>