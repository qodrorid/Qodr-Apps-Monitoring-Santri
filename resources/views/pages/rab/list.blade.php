@foreach($rab as $item)
<tr id="row-rab-{{ $item->id }}" {!! $disable ? 'class="disabled-row"' : '' !!}>
    <td align="center">{{ $loop->iteration }}</td>
    <td>{{ $item->for }}</td>
    <td align="center">{{ $item->qty }}</td>
    <td align="right">{!! HelperView::currency($item->price) !!}</td>
    <td align="right">{!! HelperView::currency($item->total) !!}</td>
    <td class="action" align="center">
        @if (!$disable)
        <button type="button" class="btn btn-primary btn-sm pr-2" onclick="edit({{ $item->id }}, '{{ json_encode($item->toArray()) }}')">
            <i class="feather icon-edit"></i>
        </button>
        <button type="button" class="btn btn-danger btn-sm pr-2" onclick="deleted({{ $item->id }})">
            <i class="feather icon-trash-2"></i>
        </button>
        @endif
    </td>
</tr>
@endforeach