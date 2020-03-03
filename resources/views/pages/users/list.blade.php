@php($no = $users->perPage() * $users->currentPage() - $users->perPage() + 1)
@foreach ($users as $item)    
<tr class="{{ is_null($item->email_verified_at) ? 'table-active' : '' }}">
    <td align="center">{{ $no }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->email }}</td>
    <td>{{ $item->username }}</td>
    <td>
        <span class="label {{ HelperView::labelRole($item->role_id) }}">
            {{ $item->role->name }}
        </span>
    </td>
    <td class="action">
        <div class="dropdown-primary dropdown open btn-block">
            <button class="btn btn-primary btn-sm btn-block dropdown-toggle" type="button" id="action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                <i class="feather icon-cpu"></i> Action
            </button>
            <div class="dropdown-menu" aria-labelledby="action" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                <a class="dropdown-item">
                    <i class="feather icon-file-text"></i> Detail
                </a>
                @if (is_null($item->email_verified_at))
                <a class="dropdown-item" onclick="verified({{ $item->id }})">
                    <i class="feather icon-check"></i> Verified
                </a>
                @endif
                <a class="dropdown-item" onclick="resetpassword({{ $item->id }})">
                    <i class="feather icon-refresh-cw"></i> Reset Password
                </a>
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