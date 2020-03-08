@php($no = $users->perPage() * $users->currentPage() - $users->perPage() + 1)
@foreach ($users as $item)    
<tr>
    <td align="center">{{ $no }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->username }}</td>
    <td class="action">
        <a href="{{ route('wakatime.view-report', ['userid' => $item->id]) }}" class="btn btn-block btn-sm btn-primary">
            <i class="feather icon-eye"></i> View Report
        </a>
    </td>
</tr>
@php($no = $no + 1)
@endforeach

@if ($users->total() < 1)
<tr>
    <td colspan="5" align="center">Data not found</td>
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