@php($no = $income->perPage() * $income->currentPage() - $income->perPage() + 1)
@foreach ($income as $item)    
<tr>
    <td align="center">{{ $no }}</td>
    <td>{{ $item->name }}</td>
    <td align="right">{!! HelperView::currency($item->nominal) !!}</td>
    <td class="action">
        @if (!$item->status)
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
        @endif
    </td>
</tr>
@php($no = $no + 1)
@endforeach

@if ($income->total() < 1)
<tr>
    <td colspan="5" align="center">Data not found</td>
</tr>
@endif

<script>
(function() {
    @if ($income->lastPage() > 1)
        $('#pagination').html(`{{ $income->links('components.pagination.ajax') }}`)
    @else
        $('#pagination').html('')
    @endif
})()
</script>